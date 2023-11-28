<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name', 'parent_id','category_image'
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
        public function thirdCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function forthCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function size()
    {
        return $this->hasMany(Size::class);
    }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'parent_id');
    // }

}
