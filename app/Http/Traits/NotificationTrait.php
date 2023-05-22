<?php

namespace App\Http\Traits;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

trait NotificationTrait
{
    public function createNotification($receiver_id, $message, $data = [], $title = null)
    {
        $notification = new Notification();
        $notification->title = $title;
        $notification->message = $message;
        $notification->receiver_id = $receiver_id;
        $notification->is_read = 0;
        $notification->data = $data;
        $notification->save();

        return $notification;
    }

    public function markNotificationAsRead($notificationId)
    {
        $notification = Notification::where('id', $notificationId)
            ->where('receiver_id', Auth::id())
            ->first();

        if ($notification) {
            $notification->is_read = 1;
            $notification->save();
            return true;
        }
        return false;
    }

    public function markAllNotificationsAsRead()
    {
        Notification::where('recipient_id', Auth::id())
            ->update(['read' => true]);
    }

    public function deleteNotification($notificationId)
    {
        Notification::where('id', $notificationId)
            ->where('recipient_id', Auth::id())
            ->delete();
    }

    public function getUnreadNotifications()
    {
        return Notification::where('recipient_id', Auth::id())
            ->where('read', false)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getAllNotifications()
    {
        return Notification::where('recipient_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
