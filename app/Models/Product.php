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
    protected $appends = [
        'favourites_count',
        'is_favourite'
    ];


    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function favourites()
    {
        return $this->hasMany(Favourite::class, 'product_id');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class);
    }

    public function getProductById($id)
    {
        return $this->where('id', $id)->first();
    }
    public function getFavouritesCountAttribute()
    {
        return $this->favourites()->count();
    }
    public function getIsFavouriteAttribute()
    {
        return $this->favourites()->where('user_id', auth()->user()->id)->count();
    }
}
