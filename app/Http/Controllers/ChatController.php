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
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\NumberParseException;

class ChatController extends Controller
{
    use ResponseTrait;

    // Check phone number 
    public function checkNumber($phoneNumber)
    {
        $phoneNumberUtil = PhoneNumberUtil::getInstance();

        try {
            $parsedNumber = $phoneNumberUtil->parse($phoneNumber, null);
            if ($phoneNumberUtil->isValidNumber($parsedNumber)) {
                // The string is a valid phone number
                return true;
            } else {
                // The string is not a valid phone number
                return false;
            }
        } catch (NumberParseException $e) {
            // The string is not a valid phone number
            return false;
        }
    }

    // Send message or create chat 
    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otherUserId' => 'required|exists:users,id',
            'content' => 'required',
            'type' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        if ($request->otherUserId === auth()->user()->id) {
            return $this->sendError('Warning! You cannot send message to yourself.');
        }
        if (filter_var($request->content, FILTER_VALIDATE_EMAIL)) {
            return $this->sendError('Warning! You cannot send emails in chat.');
        }
        $isNumber = $this->checkNumber($request->content);
        if ($isNumber) {
            return $this->sendError('Warning! You cannot send contact number in chat.');
        }
        $request->merge(['client_id' => auth()->user()->id]);
        if (auth()->user()->is_business == 0) {
            $userId = auth()->user()->id;
            $vendorId = $request->otherUserId;
        } else {
            $vendorId = auth()->user()->id;
            $userId = $request->otherUserId;
        }
        $chat = Chat::updateOrCreate(['client_id' => $userId, 'vendor_id' => $vendorId]);

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
        dd(json_decode($chats));
        if (!empty($chats)) {
            foreach ($chats as $chat) {
                $chat->unreadCount = 0;
                if (!empty($chat['lastMessage']) && $chat['lastMessage']['sender_id'] !== auth()->user()->id) {
                    $chat->unreadCount = Message::where(['chat_id' => $chat->id, 'is_read' => 0])->count();
                }
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
            if (isset($request->otherUserId)) {
                $existingChat = Chat::where(['client_id' => $loginUserId, 'vendor_id' => $request->otherUserId])->orWhere(['client_id' => $request->otherUserId, 'vendor_id' => $loginUserId])->first();
                if (!empty($existingChat)) {
                    unset($request->chat_id);

                    $chat_id = $existingChat->id;
                    $request->merge(['chat_id' => $chat_id]);
                } else {
                    return $this->sendError(implode(",", $validator->messages()->all()));
                }
            } else {
                return $this->sendError(implode(",", $validator->messages()->all()));
            }
        }
        $lastMsgSenderId = Message::where('chat_id', $request->chat_id)
            ->latest('created_at')
            ->limit(1)
            ->pluck('sender_id')
            ->first();
        if ($lastMsgSenderId !== $loginUserId) {
            Message::where('chat_id', $request->chat_id)->update(['is_read' => 1]);
        }
        $chat = Chat::find($request->chat_id);
        if ($request->type == 'before') {
            $orderDate = Order::where(['user_id' => $chat->client_id, 'vendor_id' => $chat->vendor_id])->first('created_at');
            if ($orderDate != null) {
                $chatMessages = Message::where('chat_id', $request->chat_id)->whereDate('created_at', '<', $orderDate)->orderBy('created_at', 'DESC')->get();
            } else {
                $chatMessages = Message::where('chat_id', $request->chat_id)->orderBy('created_at', 'DESC')->get();
            }
        } elseif ($request->type == 'after') {
            $orderDate = Order::where(['user_id' => $chat->client_id, 'vendor_id' => $chat->vendor_id])->first('created_at');
            if ($orderDate != null) {
                $chatMessages = Message::where('chat_id', $request->chat_id)->whereDate('created_at', '>', $orderDate)->orderBy('created_at', 'DESC')->get();
            } else {
                $chatMessages = Message::where('chat_id', $request->chat_id)->orderBy('created_at', 'DESC')->get();
            }
        }
        return $this->sendResponse($chatMessages, 'All chat messages');
    }
}
