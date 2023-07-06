<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Models\Rider;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class DashboardRequest extends FormRequest
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
        $customers = Customer::count();
        $vendors = Vendor::count();
        $orders = Order::count();
        $riders = Rider::count();

        $top_customer = Customer::withCount('order')
        ->where('id','<>',2)
        ->orderBy('order_count','desc')
        ->first();

        $top_vendor = Vendor::withCount('orderItems')
        ->orderBy('order_items_count','desc')
        ->first();

        $top_product = Product::join('order_items as oi','products.id','=','oi.product_id')
        ->select('products.name', \DB::raw('count(*) as total_order'))
        ->groupBy('products.name')
        ->orderBy('total_order','desc')
        ->first();
        
        $data = [
            'customers' => $customers, 
            'vendors' => $vendors, 
            'orders' => $orders, 
            'riders' => $riders,
            'top_customer' => $top_customer->user->first_name.' '.$top_customer->user->last_name,
            'top_vendor' => $top_vendor->vendor_name,
            'top_product' => $top_product->name
        ];
        
        return $data;
    }
}
