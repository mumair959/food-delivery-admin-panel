<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class GetAllOrdersRequest extends FormRequest
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
        $orders = Order::select(
            'orders.id',
            'orders.customer_id',
            'orders.tracking_id',
            'orders.order_deliver_address',
            'orders.net_amount',
            'orders.delivery_fee',
            'orders.promocode_fare',
            'orders.vat',
            'orders.payment_status',
            'orders.created_at')
        ->withCount('orderItems')
        ->with(['orderItems.product','orderItems.productVariant','customer.user','orderItems.vendor','address'])
        ->orderBy('id','DESC')
        ->paginate(10);

        foreach($orders as $order){
            $order->order_duration = \Carbon\Carbon::createFromTimeStamp(strtotime($order->created_at))->diffForHumans();
            $order->order_on = date("d-M-Y h:i a", strtotime($order->created_at));
            $order->order_status = ($order->tracking_id == null) ? 'Pending' : 'Received';
        }

        return $orders;
    }
}
