<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
   public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    protected $fillable = [
        'vendor_id',
        'title',
        'size',
        'condition',
        'description',
        'category_id',
        'brand',
        'price',
        'country',
        'city',
        'order_id',
        'product_id',
        'location',
        'lat',
        'long',
        'sub_categoryId',
        'status'
    ];
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
    public function insertData($data, $productId, $orderId)
    {
        $data['product_id'] = $productId;
        $data['order_id'] = $orderId;
        // dd($data);
        return $this->create($data);
    }
}
