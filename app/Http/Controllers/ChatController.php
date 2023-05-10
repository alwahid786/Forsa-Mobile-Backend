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
use App\Models\Chat;
use App\Models\Message;
use App\Http\Requests\SignupRequest;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Stripe;
use App\Http\Controllers\SettingController;

class ChatController extends Controller
{
    use ResponseTrait;

    // Send message or create chat 
    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required|exists:users,id',
            'content' => 'required',
            'type' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        if (filter_var("some@address.com", FILTER_VALIDATE_EMAIL)) {
            // valid address
        } else {
            // invalid address
        }
        $request->merge(['client_id' => auth()->user()->id]);
        $chat = Chat::updateOrCreate(['id' => $request->chat_id], $request->all());

        $message = new Message;
        $message->chat_id = $chat->id;
        $message->sender_id = auth()->user()->id;
        $message->type = $request->type;
        $message->content = json_encode($request->content);
        $message->save();
        if ($message) {
            return $this->sendResponse($message, 'Message sent Successfully.');
        }
        return $this->sendError('Message was not sent.');
    }

    // Get All chats 
    public function allChats(Request $request)
    {
        $loginUserId = auth()->user()->id;
        $chats = Chat::where('client_id', $loginUserId)->orWhere('vendor_id', $loginUserId)->with('lastMessage')->get();

        if (count($chats) > 0) {
            foreach ($chats as $chat) {
                if ($chat['client_id'] != $loginUserId) {
                    $chat['userData'] = User::find($chat['client_id']);
                } elseif ($chat['vendor_id'] != $loginUserId) {
                    $chat['userData'] = User::find($chat['vendor_id']);
                }
            }
            return $this->sendResponse($chats, "List of All chats");
        } else {
            return $this->sendError('No chats for now');
        }
    }

    // Show Chat details 
    public function chatDetail(Request $request)
    {
        $loginUserId = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'chat_id' => 'required|exists:chats,id',
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        $chat = Chat::find($request->chat_id);
        if ($request->type == 'before') {
            $orderDate = Order::where(['user_id' => $chat->client_id, 'vendor_id' => $chat->vendor_id])->pluck('created_at');
            if ($orderDate != null) {
                $chatMessages = Message::where('chat_id', $request->chat_id)->whereDate('created_at', '<', $orderDate)->orderBy('created_at', 'DESC')->get();
            } else {
                $chatMessages = Message::where('chat_id', $request->chat_id)->orderBy('created_at', 'DESC')->get();
            }
        } elseif ($request->type == 'after') {
            $orderDate = Order::where(['user_id' => $chat->client_id, 'vendor_id' => $chat->vendor_id])->pluck('created_at');
            if ($orderDate != null) {
                $chatMessages = Message::where('chat_id', $request->chat_id)->whereDate('created_at', '>', $orderDate)->orderBy('created_at', 'DESC')->get();
            } else {
                $chatMessages = Message::where('chat_id', $request->chat_id)->orderBy('created_at', 'DESC')->get();
            }
        }
        return $this->sendResponse($chatMessages, 'All chat messages');
    }
}
