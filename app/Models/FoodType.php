<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    public function products()
    {
        return $this->hasMany('App\Models\Product','food_id');
    }

    public function orderItem()
    {
        return $this->hasManyThrough('App\Models\Product', 'App\Models\OrderItem','product_id','food_id');
    }
}
