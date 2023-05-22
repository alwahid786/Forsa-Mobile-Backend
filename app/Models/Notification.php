<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function getDataAttribute($value)
    {
        return json_decode($value, true);
    }
    
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y', strtotime($value));
    }
}
