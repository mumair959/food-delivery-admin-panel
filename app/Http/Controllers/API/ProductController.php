<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function getHomeProducts()
    {
        $products = Product::withCount('orderItem')->orderBy('order_item_count', 'desc')->take(12)->get();
        return response()->json(['products'=>$products], 200);
    }
}
