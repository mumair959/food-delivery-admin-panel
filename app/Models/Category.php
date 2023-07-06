<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function vendors()
    {
        return $this->hasMany('App\Models\Vendor');
    }
}
