<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FilterProductsRequest extends FormRequest
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
        $products = Product::join('vendors as v','v.id','=','products.vendor_id')
        ->join('food_types as ft','ft.id','=','products.food_id')
        ->select(
            'products.id',
            'products.name',
            'products.net_price',
            \DB::raw("(CASE WHEN (products.is_active = '1') THEN 1 ELSE 0 END) as is_active"),
            'v.vendor_name',
            'ft.name as category')
            ->when(request()->vendor_id,function ($query){
                return $query->where('v.id','=',request()->vendor_id);
            })
            ->when(request()->item_id,function ($query){
                return $query->where('ft.id','=',request()->item_id);  
            })
        ->paginate(10);
        return $products;
    }
}
