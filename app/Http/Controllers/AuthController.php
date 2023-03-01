<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use App\Models\User;
use App\Models\BusinessProfile;
use App\Http\Requests\SignupRequest;
use App\Http\Traits\ResponseTrait;

class AuthController extends Controller
{
    use ResponseTrait;

    // Register Function 
    public function signup(SignupRequest $request)
    {
        $data = $request->all();
        $user = User::create($data);
        if ($user) {
            if ($request->is_business == 1) {
                BusinessProfile::create([
                    'business_name' => $request->business_name,
                    'business_tagline' => $request->business_tagline,
                    'business_description' => $request->business_description,
                    'business_image' => $request->business_image,
                    'user_id' => $user['id'],
                ]);
            }
            return $this->sendResponse($user, 'Your profile has been successfully created!');
        } else {
            return $this->sendError('Your profile cannot be created at the moment, Try signing up later.');
        }
    }
}
