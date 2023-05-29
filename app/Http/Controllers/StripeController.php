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
use App\Models\Withdraw;
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
        $profiles = BusinessProfile::where('user_id', $loginUserId)->update(['stripe_client_id' => $response['stripe_user_id']]);
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
        $stripeUser = BusinessProfile::where('user_id', $loginUserId)->first();
        if ($stripeUser != '') {
            // Check If Withdraw amount is > available balance 
            if ($stripeUser->availableBalance < $request->amount) {
                return $this->sendError('Warning! Your available balance is less than your withdraw request!');
            }
            $stripe = new \Stripe\StripeClient(env(
                'STRIPE_SECRET'
            ));

            // Transfer Amount to connected Account 
            $transfer = $stripe->transfers->create([
                'amount' => $request->input('amount'),
                'currency' => 'usd',
                'destination' => $stripeUser['stripe_client_id'],
            ]);
            // If transfer succeeded 
            if (isset($transfer->id) && !empty($transfer->id)) {
                $withdraw = new Withdraw();
                $withdraw->vendor_id = $loginUserId;
                $withdraw->amount = $request->amount;
                $withdraw->status = 1;
                $withdraw->transaction_id = $transfer->id;
                $result = $withdraw->save();
                if ($result) {
                    $message = 'Amount of $' . $request->amount . ' has been successfully transferred to your account. Thank You for using FORSA.';
                    return $this->sendResponse($withdraw, $message);
                }
                // If Data not saved in record then create a refund 
                try {
                    $refund = \Stripe\Refund::create([
                        'charge' => $transfer->id,
                        'amount' => $request->price,
                    ]);
                    return $this->sendError('Something went wrong while saving record. Apologies for inconvenience. Please try again in a while.');
                } catch (\Stripe\Exception\ApiErrorException $e) {
                    return $this->sendError('Something went wrong while saving record. Apologies for inconvenience. Please try again in a while.');
                }
            }
        }
        return $this->sendError('Warning! You have not connected you stripe account yet!');
    }
}
