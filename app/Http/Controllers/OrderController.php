<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\BusinessProfile;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Views;
use App\Models\Favourite;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\Review;
use App\Models\ReviewImage;
use App\Http\Requests\SignupRequest;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Stripe;

class OrderController extends Controller
{
    use ResponseTrait;

    // Place Order Function 
    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'vendor_id' => 'required|exists:users,id',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'payment_intent' => 'required',
            'intent_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }

        // Create Order 
        $order = new Order;
        $order->product_id = $request->product_id;
        $order->vendor_id = $request->vendor_id;
        $order->address = $request->address;
        $order->latitude = $request->latitude;
        $order->longitude = $request->longitude;
        $order->payment_intent = $request->payment_intent;
        $order->intent_id = $request->intent_id;
        $order->user_id = auth()->user()->id;
        $order->save();

        // Get Product 
        $product = new Product;
        $productData = $product->getProductById($request->product_id);
        // Save Order History 
        $orderHistory = new OrderHistory;
        $status = $orderHistory->insertData($productData->toArray(), $request->product_id, $order->id);
        $order['productDetails'] = $status;
        return $this->sendResponse($order, 'Order created successfully.');
    }

    // Payment Intent 
    public function paymentIntent(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = $stripe->customers->create([
            'description' => 'Forsa Product Customer',
        ]);

        $ephemeralKey = \Stripe\EphemeralKey::create(
            ['customer' => $customer->id],
            ['stripe_version' => '2020-08-27']
        );
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $request->amount * 100,
            'currency' => 'usd',
            'customer' => $customer->id,
        ]);

        $pay_int_res = [
            'result' => 'Success',
            'message' => 'Payment intent successfully!',
            'payment_intent' => $paymentIntent->client_secret,
            'ephemeral_key' => $ephemeralKey->secret,
            'customer_id' => $customer->id,
            'publishablekey' => env('STRIPE_KEY'),
            'secret' => env('STRIPE_SECRET'),
            'id' => $paymentIntent->id
        ];
        return $this->sendResponse($pay_int_res, 'Payment Intent');
    }

    // Order history 
    public function orderHistory(Request $request)
    {
        $loginUserId = auth()->user()->id;
        $orders = Order::where('user_id', $loginUserId)->with('orderHistory', 'orderHistory.productImages')->get();
        if (!empty($orders)) {
            foreach ($orders as $order) {
                $order->statusText = $order->status_text;
                $order->orderDate = date('M d, Y', strtotime($order->created_at));
                $order->buyerProtectionFees = ($order['orderHistory']['price'] * 5) / 100 + 0.70;
                $order->totalFees = ($order['orderHistory']['price'] * 5) / 100 + 0.70 + $order['orderHistory']['price'];
            }
        }
        return $this->sendResponse($orders, "Order details found successfully.");
    }

    // Change Order Status 
    public function changeOrderStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        if ($request->status == 5) {
            $orderStatus = Order::where('id', $request->order_id)->first();
            if ($orderStatus->status != 4) {
                return $this->sendError('This order is not delivered yet! You cannot complete it before it is delivered.');
            }
        }
        $order = Order::where('id', $request->order_id)->update(['status' => $request->status]);
        if ($order) {
            return $this->sendResponse([], "Order status successfully updated");
        }
        return $this->sendError('Could not update status, Try later!');
    }

    // Add Review Function 
    public function addReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required',
            'review_text' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        // Check Order status if Completed 
        $orderStatus = Order::where('id', $request->order_id)->first();
        if ($orderStatus->status != 5) {
            return $this->sendError('You cannot add review on an uncompleted order!');
        }
        // Check if rating is in between 1-5 
        if ($request->rating < 1 || $request->rating > 5) {
            return $this->sendError('Rating should be in between 1 to 5');
        }
        // Add review 
        $review = new Review;
        $review->product_id = $request->product_id;
        $review->user_id = $request->user_id;
        $review->rating = $request->rating;
        $review->review_text = $request->review_text;
        $reviewStatus = $review->save();
        if ($reviewStatus) {
            if ($request->has('review_images') && !empty($request->review_images)) {
                foreach ($request->review_images as $image) {
                    $reviewImage = new ReviewImage;
                    $reviewImage->review_id = $review->id;
                    $reviewImage->review_image = $image;
                    $reviewImage->save();
                }
            }
            return $this->sendResponse([], 'Review Added successfully');
        }
        return $this->sendError('Something went wrong! try again later.');
    }
}
