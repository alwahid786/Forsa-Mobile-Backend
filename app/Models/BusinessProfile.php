<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'business_name',
        'business_tagline',
        'business_description',
        'business_image',
        'profile_status'
    ];
    protected $appends = [
        'rating',
        'availableBalance'
    ];

    public function getRatingAttribute()
    {
        $vendorId = $this->user_id;
        $ratingCount = Review::where('vendor_id', $vendorId)->count();
        if ($ratingCount > 0) {
            $ratingSum = Review::where('vendor_id', $vendorId)->sum('rating');
            $avgRating = $ratingSum / $ratingCount;
            return $avgRating;
        }
        return $ratingCount;
    }
    
    public function getAvailableBalanceAttribute()
    {
        $totalBalance = Order::where([['vendor_id', '=', $this->user_id], ['status', '!=', 6]])->sum('total');
        $totalWithdraws = Withdraw::where('vendor_id', $this->user_id)->sum('amount');
        $availableBalance = $totalBalance - $totalWithdraws;
        return $availableBalance;
    }
}
