<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\OrderTrack;
use App\Events\OrderPlaced;

class OrderController extends Controller
{
    public function getAllOrders($user_id)
    {
        $customer = Customer::select('id')->where('user_id',$user_id)->first();
        $orders = Order::where('customer_id',$customer->id)->with('orderItems')->orderBy('id','DESC')->get();
        
        if(count($orders) <= 0){
            return response()->json(['msg'=>'No orders found']);
        }
        else{
            foreach($orders as $order){
                $order_status = OrderTrack::select('status','message')->where('order_id',$order->id)->orderBy('id','DESC')->first();
                $order->order_status = ($order_status) ? $order_status->status : 'Pending';
                $order->message = ($order_status) ? $order_status->message : null;
                $order->order_on = date("d-M-Y h:i a", strtotime($order->created_at));
                $order->deliver_on = date("d-M-Y h:i a", strtotime($order->created_at.' + 45 minute'));
            }
            return response()->json(['orders'=>$orders], 200);
        }
    }

    public function getOrder($order_id)
    {
        $order = Order::where('orders.id',$order_id)
        ->join('customer_address as ca','ca.id','=','orders.order_deliver_address')
        ->join('addresses as a','a.id','=','ca.address_id')
        ->join('customers as c','c.id','=','orders.customer_id')
        ->join('users as u','u.id','=','c.user_id')
        ->select(
            'orders.id',
            'orders.tracking_id',
            'orders.amount',
            'orders.note',
            'orders.net_amount',
            'orders.delivery_fee',
            'orders.vat',
            'orders.wallet_redeem',
            'orders.promocode_fare',
            'orders.created_at',
            'c.phone_num',
            'u.first_name',
            'u.last_name',
            'u.email',
            'a.house_num',
            'a.street',
            'a.area',
            'a.nearest_place')
        ->with(['orderItems' => function($query){
            $query->join('products', 'order_items.product_id', '=', 'products.id')
                    ->join('vendors', 'order_items.vendor_id', '=', 'vendors.id')
                    ->leftJoin('product_variants', 'order_items.product_variant_id', '=', 'product_variants.id')
                    ->select(
                        'order_items.id',
                        'order_items.order_id',
                        'order_items.net_price',
                        'order_items.quantity',
                        'order_items.price',
                        'products.name',
                        'products.description',
                        'products.measure_unit',
                        'product_variants.variant_val_1',
                        'product_variants.variant_val_2',
                        'product_variants.variant_val_3',
                        'vendors.vendor_name'
                    );
        }])->first();

        if(!$order){
            return response()->json(['msg'=>'Order not found']);
        }
        else{
            return response()->json(['order'=>$order], 200);
        }
    }

    public function placeOrder(Request $request)
    {
        $customer = Customer::select('id')->where('user_id',$request->user_id)->first();
        $order_num = $this->generateOrderNum();
        try{
            $order = new Order();
            $order->customer_id = $customer->id;
            $order->amount = $request->subtotal;
            $order->discount_type = 'None';
            $order->discount = 0;
            $order->admin_comission = 10;
            $order->delivery_fee = $request->delivery_fee;   
            $order->vat = $request->vat; 
            $order->promocode_fare = isset($request->promocode_fare) ? $request->promocode_fare : null;
            $order->wallet_redeem = isset($request->wallet_redeem) ? $request->wallet_redeem : null;            
            $order->net_amount = $request->total;
            $order->payment_status = 'Unpaid';
            $order->order_num = $order_num;
            $order->note = $request->note;
            $order->order_deliver_address = $request->address_id;

            if(isset($request->voucher_id)){
                \DB::table('user_vouchers')->insert([
                    'user_id' => $request->user_id,
                    'customer_id' => $customer->id,
                    'voucher_id' => $request->voucher_id,
                ]);
            }
    
            if($order->save()){
                foreach($request->orderItems as $item){
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $item['product_id'];
                    $orderItem->vendor_id = $item['vendor_id'];
                    $orderItem->product_variant_id = (array_key_exists('product_variant_id',$item)) ? $item['product_variant_id']:null;
                    $orderItem->price = $item['net_price'];
                    $orderItem->quantity = $item['quantity'];
                    $orderItem->net_price = $item['net_price'];
                    $orderItem->save();
                }

                $user = User::findOrFail($request->user_id);

                event(new OrderPlaced($user,$order));
                return response()->json(['success'=>'Your order placed successfully'],200);            
            }
            else{
                return response()->json(['error'=>'Order not placed, Please try again']);
            }
        }
        catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()], 200);
        } 
    }

    public function generateOrderNum()
    {
        $randString = str_random(6);
        $orderNum = Order::where('order_num',$randString)->first();
        if ($orderNum) {
            $this->generateOrderNum();
        }
        return $randString;
    }

    public function test_sms()
    {
        // $user = User::find(15);
        // $order = Order::find(1);
        
        // event(new OrderPlaced($user,$order));
        $json_data = [
            "notification" => [
              "title" => "Ionic 4 Notification 3",
              "body" => "This notification sent from POSTMAN using Firebase HTTP protocol 3",
              "sound" => "default",
              "click_action" => "FCM_PLUGIN_ACTIVITY",
              "icon" => "fcm_push_icon"
            ],
            "data" => [
              "landing_page" => "new_orders"
            ],
              "to" => "e41QRg8JReuzJHSAnxVl8r:APA91bGr1yImTTa0mmwEYRXHySmg4j0iFqVR4Din25kgjOV_3Prbt97xh_HMH-1IGyH4ZLJoz4P0x1JyxlrrVPM72B1xvJJa0EsokQFA7cCJjki-29ka3259RA34OhUEOG1sy5G3Rdl2",
              "priority" => "high",
              "restricted_package_name" => ""
        ];

        $data = json_encode($json_data);
        //FCM API end-point
        $url = 'https://fcm.googleapis.com/fcm/send';
        //api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        $server_key = 'AAAAILb9iRY:APA91bF0h_xAPSbC4vBozDBZ8x3BiKcEhTNaNXNRp9ZpaWb2ly4-BiWd0Yo70onBX6ZDurNK83VncUIrMAp32CQ1__j8LtlrBzbyf9YqIqT5C_jQY5aak-rjs0sz3-FYZEbetwy96I0x';
        //header with content_type api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$server_key
        );
        //CURL request to route notification to FCM connection server (provided by Google)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        // if ($result === FALSE) {
        //     die('Oops! FCM Send Error: ' . curl_error($ch));
        // }
        curl_close($ch);
        return response()->json($result);
    }
}
