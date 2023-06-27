<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'vendor_id'
    ];
    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($model) {
            $model->append('last_message_time_difference');
        });
    }

    public function getLastMessageTimeDifferenceAttribute()
    {
        return $this->LastMessageTimeDifference();
    }


    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latest('created_at');
    }

    public function LastMessageTimeDifference()
    {
        $lastMessage = $this->hasMany(Message::class)->latest('created_at')->limit(1)->first();

        if (!$lastMessage) {
            return null; // No last message found
        }

        return Carbon::parse($lastMessage->created_at)->diffForHumans();
    }
}
