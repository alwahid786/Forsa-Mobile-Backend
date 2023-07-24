<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\BusinessProfile;
use App\Http\Requests\SignupRequest;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    use ResponseTrait;

    // Register Function 
    public function signup(SignupRequest $request)
    {
        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        if ($user) {
            if ($request->is_business == 1) {
                BusinessProfile::create([
                    'business_name' => $request->business_name,
                    'business_tagline' => $request->business_tagline,
                    'business_description' => $request->business_description,
                    'business_image' => $request->business_image,
                    'user_id' => $user['id'],
                    'profile_status' => 1,
                ]);
            }
            $user = User::find($user->id);
            return $this->sendResponse($user, 'Your profile has been successfully created!');
        } else {
            return $this->sendError('Your profile cannot be created at the moment, Try signing up later.');
        }
    }

    // Login Function 
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $loginData = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (!auth()->attempt($loginData)) {
            return $this->sendError('Incorrect Email or Password, Try again or click Forget Password.');
        }
        $user = auth()->user();
        $userData = User::where('id', $user->id)->with('businessProfile')->first();
        $userData['token'] = $user->createToken('API Token')->accessToken;
        return $this->sendResponse($userData, 'Logged in Successfully!');
    }

    // Switch to Vendor Profile From User for First Time
    public function updateToVendorProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $userType = Auth::user()->is_business;
        $businessProfile = BusinessProfile::where('user_id', $userId)->first();
        dd($businessProfile);
        if ($userType === 0) {
            if ($businessProfile == null) {
                $validator = Validator::make($request->all(), [
                    'business_name' => 'required|string',
                    'business_tagline' => 'required|string',
                    'business_description' => 'required|string',
                    'business_image' => 'required|string',
                ]);
                if ($validator->fails()) {
                    return $this->sendError('Validation Error.', $validator->errors());
                }
                $data = $request->all();
                $data['user_id'] = $userId;
                $data['profile_status'] = 1;
                $business = BusinessProfile::create($data);
            } else {
                $businessProfile->update($request->except('_token'));
            }
            $userData = User::where('id', $userId)->first();
            $userData->update(['is_business' => 1]);
            $userData = User::where('id', $userId)->with('businessProfile')->first();
            $userData = json_decode($userData, true);
            $user = auth()->user();
            $userData['token'] = $user->createToken('API Token')->accessToken;
            return $this->sendResponse($userData, 'Profile role switched successfully!');
        } else {
            $userData = User::where('id', $userId)->first();
            $userData->update(['is_business' => 0]);
            $userData = User::where('id', $userId)->with('businessProfile')->first();
            $userData = json_decode($userData, true);
            $user = auth()->user();
            $userData['token'] = $user->createToken('API Token')->accessToken;
            return $this->sendResponse($userData, 'Profile role switched successfully!');
        }
    }

    // Reset password Function 
    public function forgotEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $email = $request->email;
        $otp = rand(1000, 9999);
        if (!User::where('email', $email)->update(['otp_code' => $otp])) {
            return $this->sendError('Unable to proccess. Please try again later');
        }
        // Mail::to($email)->send(new OtpMail($otp));
        return $this->sendResponse($otp, "An OTP Code is sent to your registered email.");
    }

    // Verify Otp Code Function
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp_code' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        if (!User::where([['email', '=', $request->email], ['otp_code', '=', $request->otp_code]])->exists()) {
            return $this->sendError('Invalid Code.');
        }
        return $this->sendResponse([], 'Otp code Verified.');
    }

    // Reset Password after Verifying OTP Code function 
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
            'email' => 'required|email|exists:users,email'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Password should not be less than 8 digits and must match.', $validator->errors());
        }

        if (!User::where('email', $request->email)->update(['otp_code' => Null, 'password' => bcrypt($request->password)])) {
            return $this->sendError('Unable to process. Please try again later.');
        }
        return $this->sendResponse([], 'Your Password has been successfully updated!');
    }

    // Logout API 
    public function logout(Request $request)
    {
        if (Auth::check()) {
            // Log the user out
            $request->user()->tokens()->delete();
            return $this->sendResponse([], "logged Out Successfully!");
        }
        return $this->sendError('Unauthorized');
    }
}
