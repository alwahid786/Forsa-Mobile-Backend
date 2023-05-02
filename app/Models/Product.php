<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $hidden = [
        'views'
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getProductById($id)
    {
        return $this->where('id', $id)->first();
    }
}
