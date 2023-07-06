<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    public function orderTrack()
    {
        return $this->hasOne('App\Models\OrderTrack');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address','order_deliver_address');
    }
}
