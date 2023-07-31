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
use App\Models\Chat;
use App\Models\OrderHistory;
use App\Models\Review;
use App\Models\ReviewImage;
use App\Http\Requests\SignupRequest;
use App\Http\Traits\ResponseTrait;
use App\Http\Traits\NotificationTrait;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpMail;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use Stripe;

class OrderController extends Controller
{
    use ResponseTrait, NotificationTrait;

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
            'total' => 'required'
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
        $order->total = $request->total;
        $order->save();

        // Get Product 
        $product = new Product;
        $productData = $product->getProductById($request->product_id);
        // Save Order History 
        $orderHistory = new OrderHistory;
        $status = $orderHistory->insertData($productData->toArray(), $request->product_id, $order->id);
        $order['productDetails'] = $status;

        // Send Notification to Vendor 
        $userName = auth()->user()->name;
        $message = $userName . ' placed an order on your product ' . $productData['title'];
        $image = ProductImage::where('product_id', $request->product_id)->first('image');
        $data = [
            'action' => 'ORDER_PLACED',
            'orderId' => $order->id,
            'image' => $image->image
        ];
        $this->createNotification($request->vendor_id, $message, $data, 'Order Placed');

        // Update Product Quantity 
        Product::where('id', $request->product_id)->decrement('remaining_items', 1);

        // Return response 
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
        $userType = auth()->user()->is_business;
        $orders = Order::where('user_id', $loginUserId)->with('orderHistory', 'orderHistory.productImages', 'userProfile', 'vendorProfile', 'vendorUserProfile')->get();
        if ($userType == 1) {
            $orders = Order::where('vendor_id', $loginUserId)->with('orderHistory', 'orderHistory.productImages', 'userProfile', 'vendorProfile')->get();
        }
        if (!empty($orders)) {
            foreach ($orders as $order) {
                if (isset($order['orderHistory']) && $order['orderHistory'] !== null) {
                    $chat = Chat::where(['client_id' => $order->user_id, 'vendor_id' => $order->vendor_id])->orwhere(['client_id' => $order->vendor_id, 'vendor_id' => $order->user_id])->first();
                    $order->chat_id = null;
                    if (!empty($chat)) {
                        $order->chat_id = $chat->id;
                    }
                    $order->statusText = $order->status_text;
                    $order->orderDate = date('M d, Y', strtotime($order->created_at));

                    $order->buyerProtectionFees = ($order['orderHistory']['price'] * 5) / 100 + 0.70;
                    $order->totalFees = ($order['orderHistory']['price'] * 5) / 100 + 0.70 + $order['orderHistory']['price'];
                }
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
        $orderStatus = Order::where('id', $request->order_id)->first();
        if ($request->status == 5) {
            if ($orderStatus->status != 4) {
                return $this->sendError('This order is not delivered yet! You cannot complete it before it is delivered.');
            }
        }
        // If cancelled then update Quantity 
        if ($request->status == 6) {
            Product::where('id', $orderStatus->product_id)->increment('remaining_items', 1);
        }
        $order = Order::where('id', $request->order_id)->update(['status' => $request->status]);

        // Send Notification 
        if ($request->status == 5) {
            $message = 'Your order #' . $request->order_id . ' has been marked as completed.';
            $receiverId = $orderStatus->vendor_id;
        } else {
            $message = 'Your order #' . $request->order_id . ' status has been changed';
            $receiverId = $orderStatus->user_id;
        }
        $image = ProductImage::where('product_id', $orderStatus->product_id)->first('image');
        $data = [
            'action' => 'ORDER_STATUS_CHANGED',
            'orderId' => $request->order_id,
            'image' => $image->image
        ];
        if (isset($request->notiId) && !empty($request->notiId)) {
            Notification::where('id', $request->notiId)->update(['data' => $data]);
        }
        $this->createNotification($receiverId, $message, $data, 'Order Status Changed');

        // Return response 
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
            'vendor_id' => 'required|exists:users,id',
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
        $review->vendor_id = $request->vendor_id;
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

            // Send Notification 
            $userName = auth()->user()->name;
            $message = $userName . ' has added a review on your product.';
            $product = Product::where('id', $request->product_id)->first();
            $receiverId = $product->vendor_id;
            $image = ProductImage::where('product_id', $product->id)->first('image');
            $data = [
                'action' => 'REVIEW_ADDED',
                'image' => $image->image
            ];
            $this->createNotification($receiverId, $message, $data, 'Review Added');

            return $this->sendResponse([], 'Review Added successfully');
        }
        return $this->sendError('Something went wrong! try again later.');
    }
}
