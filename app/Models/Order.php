<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $hidden = [
        'payment_intent',
        'intent_id',
        'type',
        'multiple_product_ids',
        'multiple_vendor_id'
    ];

public function products()
{
    return $this->belongsToMany(Product::class, 'order_product');
}
    public function orderHistory()
    {
        return $this->hasOne(OrderHistory::class);
    }

        public function newOrderHistory()
    {
        return $this->hasMany(OrderHistory::class);
    }

    public function userProfile()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function vendorProfile()
    {
        return $this->belongsTo(BusinessProfile::class, 'vendor_id', 'user_id');
    }
    public function vendorUserProfile() 
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }
    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case 0:
                return 'Pending';
            case 1:
                return 'Accepted';
            case 2:
                return 'Ready To Deliver';
            case 3:
                return 'On The Way';
            case 4:
                return 'Delivered';
            case 5:
                return 'Completed';
            case 6:
                return 'Cancelled';
        }
    }
}
