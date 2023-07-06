<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
