<?php

namespace App\Http\Controllers\CustomerPortal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CustomerController extends Controller
{
    public function index()
    {
        $categories = Category::take(10)->get()->pluck('name','id');
        return view('customer_views.home',['categories' => $categories]);
    }
}
