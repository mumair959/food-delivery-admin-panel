<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function productVariant()
    {
        return $this->belongsTo('App\Models\ProductVariant');
    }
}
