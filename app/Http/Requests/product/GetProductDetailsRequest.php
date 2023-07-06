<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class GetProductDetailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function process(){
        $product = Product::join('vendors as v','v.id','=','products.vendor_id')
        ->join('food_types as ft','ft.id','=','products.food_id')
        ->select(
            'products.id',
            'products.name',
            'products.description',
            'products.vendor_price',
            'products.referal_percentage',
            'products.net_price',
            'products.price', 
            'products.discount',
            'products.measure_unit',  
            'products.measure_rate', 
            \DB::raw("(CAST(products.vendor_id AS CHAR)) as vendor_id"),     
            \DB::raw("(CAST(products.food_id AS CHAR)) as food_id"),   
            \DB::raw("(CASE WHEN (products.has_variants = '1') THEN 1 ELSE 0 END) as has_variant"),            
            \DB::raw("(CASE WHEN (products.is_active = '1') THEN 1 ELSE 0 END) as is_active"),
            'v.vendor_name',
            'ft.name as category')
        ->with('productVariants')
        ->where('products.id','=',request()->id)
        ->first();
        
        $product->net_price = (int)$product->net_price;
        $product->price = (int)$product->price;
        $product->discount = (int)$product->discount; 
        
        return $product;
    }
}
