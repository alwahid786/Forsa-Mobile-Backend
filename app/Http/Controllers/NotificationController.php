<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\BusinessProfile;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Notification;
use App\Http\Requests\SignupRequest;
use App\Http\Traits\ResponseTrait;
use App\Http\Traits\NotificationTrait;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpMail;
use App\Models\Favourite;
use Illuminate\Support\Facades\Mail;
use DB;

class NotificationController extends Controller
{
    use ResponseTrait, NotificationTrait;

    // get All notifications for login user 
    public function getNotifications()
    {
        $loginUserId = auth()->user()->id;
        $notifications = Notification::where('receiver_id', $loginUserId)->get();
        if (count($notifications) > 0) {
            foreach($notifications as $noti){
                $notiData = $noti['data'];
                $notiData['id'] = intval($notiData['id']);
            }
            return $this->sendResponse($notifications, 'All notifications');
        } else {
            return $this->sendError('You have no notifications!');
        }
    }

    // Mark notification As read function 
    public function markNotificationAsRead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notification_id' => 'required|exists:notifications,id'
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        $notificationId = $request->notification_id;
        $notification = Notification::where('id', $notificationId)
            ->where('receiver_id', Auth::id())
            ->first();

        if ($notification) {
            $notification->is_read = 1;
            $status = $notification->save();
        }
        if ($status) {
            return $this->sendResponse([], 'Notification marked as read');
        }
        return $this->sendError('Something went Wrong. try again later!');
    }

    // Delete Notification Function 
    public function deleteNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notification_id' => 'required|exists:notifications,id'
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        $notificationId = $request->notification_id;
        $notification = Notification::where('id', $notificationId)->delete();
        if ($notification) {
            return $this->sendResponse([], "Notification deleted!");
        }
        return $this->sendError('Something went wrong, Please try again later.');
    }
}
