<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\BusinessProfile;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Http\Requests\SignupRequest;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpMail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Stripe;

class StripeController extends Controller
{
    use ResponseTrait;

    // Connect Stripe Account Function 
    public function stripeConnectUrl(Request $request)
    {
        $url = "https://connect.stripe.com/express/oauth/authorize?redirect_uri=" . config('app.stripe_redirected_url') . "&client_id=" . config('app.stripe_client_id') . "&scope=read_write&state=" . auth()->user()->id;
        $success['stripe_url'] = $url;
        return $this->sendResponse($success, 'Connect Url created.');
    }

    // Connected account data save function
    public function stripeRedirectUrl(Request $request)
    {
        // Retrieve the authorization code from the request
        $authorizationCode = $request->query('code');
        
        // Exchange the authorization code for an access token
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $response = $stripe->oauth->token([
            'grant_type' => 'authorization_code',
            'code' => $authorizationCode,
        ]);

        // Retrieve the connected account details
        $connectedAccountDetails = $stripe->accounts->retrieve(
            $response['stripe_user_id'],
            []
        );
        $loginUserId = $request->query('state');
        $profiles = BusinessProfile::where('user_id', $loginUserId)->update(['stripe_client_id'=> $response['stripe_user_id']]);
        if ($profiles) {
            return view('connect-success');
        }
        return $this->sendError('Your account is connected but we are unable to save records. Please Try again Later.');
    }

    // Withdraw vendor Amount 
    public function withdrawAmount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        $loginUserId = auth()->user()->id;
        $stripeId = BusinessProfile::where('user_id', $loginUserId)->first('stripe_client_id');
        if ($stripeId != '') {
            $stripe = new \Stripe\StripeClient(env(
                'STRIPE_SECRET_KEY'
            ));

            $transfer = $stripe->transfers->create([
                'amount' => $request->input('amount'),
                'currency' => 'usd',
                'destination' => $stripeId,
            ]);
            dd($transfer);
        }
        return $this->sendError('Warning! You have not coonected you stripe account yet!');
    }
}
