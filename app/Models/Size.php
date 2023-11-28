<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
     protected $fillable = [
        'category_id',
        
        'size'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function subcategories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
