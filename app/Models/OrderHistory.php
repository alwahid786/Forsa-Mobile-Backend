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
        'sub_categoryId'
    ];

    public function insertData($data, $productId, $orderId)
    {
        $data['product_id'] = $productId;
        $data['order_id'] = $orderId;
        // dd($data);
        return $this->create($data);
    }
}
