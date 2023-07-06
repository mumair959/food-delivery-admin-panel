<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function foodType()
    {
        return $this->belongsTo('App\Models\FoodType','food_id');
    }

    public function orderItem()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    public function productVariants()
    {
        return $this->hasMany('App\Models\ProductVariant');
    }
}
