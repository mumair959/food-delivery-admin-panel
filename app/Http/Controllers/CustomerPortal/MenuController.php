<?php

namespace App\Http\Controllers\CustomerPortal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\FoodType;

class MenuController extends Controller
{
    public function getMenuList($vendor_id)
    {
        $products = Product::where('vendor_id',$vendor_id)->get();
        $foodCategories = Product::select('food_id')->where('products.vendor_id',$vendor_id)->groupBy('food_id')->with('foodType')->get()->toArray();
        $categories = Category::take(10)->get()->pluck('name','id');
        // dd($foodCategories);
        return view('customer_views.menu-list',['products' => $products,'categories' => $categories, 'foodCategories' => $foodCategories]);
    }
}
