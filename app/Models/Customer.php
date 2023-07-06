<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }
}
