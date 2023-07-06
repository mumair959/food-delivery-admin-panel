<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;  
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Wallet;
use App\Models\Customer;
use App\Models\OrderTrack;
use Illuminate\Support\Facades\Auth; 
use App\Events\OrderApproved;
use App\Events\OrderDecline;
use Validator;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email', 
            'password' => 'required|string|max:20', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $admin_user = User::where(['email' => $request->email,'user_type_id' => 1])->first();

        if(!$admin_user){
            return response()->json(['msg' => 'User not exists'], 401);
        }

        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){
            return response()->json(['message' => 'Unauthorized'], 401);            
        }
        $user = $request->user();
        $tokenResult = $user->createToken('PohnchaDoSecretToken');
        $token = $tokenResult->token;
        if ($request->remember_me){
            $token->expires_at = \Carbon\Carbon::now()->addHours(1);            
        }
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => \Carbon\Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'user_id' => $user->id,
            'user_name' => $user->first_name.' '.$user->last_name,
        ]);
    }

    public function getAllOrders()
    {
        $orders = Order::orderBy('id','DESC')->get();
        
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

    public function getCancelledOrders()
    {
        $orders = Order::whereHas(['orderTrack' => function($query){
            $query->where('status', '=', 'Decline');
        }])
        ->orderBy('id','DESC')->get();
        
        if(count($orders) <= 0){
            return response()->json(['msg'=>'No orders found']);
        }
        else{
            foreach($orders as $order){
                $order_status = OrderTrack::select('status','message')->where('order_id',$order->id)->orderBy('id','DESC')->first();
                $order->order_status = $order_status->status;
                $order->message = $order_status->message;
                $order->order_on = date("d-M-Y h:i a", strtotime($order->created_at));
                $order->deliver_on = date("d-M-Y h:i a", strtotime($order->created_at.' + 45 minute'));
            }
            return response()->json(['orders'=>$orders], 200);
        }
    }

    public function getDeliveredOrders()
    {
        $orders = Order::whereHas(['orderTrack' => function($query){
            $query->where('status', '=', 'Delivered');
        }])
        ->orderBy('id','DESC')->get();
        
        if(count($orders) <= 0){
            return response()->json(['msg'=>'No orders found']);
        }
        else{
            foreach($orders as $order){
                $order_status = OrderTrack::select('status','message')->where('order_id',$order->id)->orderBy('id','DESC')->first();
                $order->order_status = $order_status->status;
                $order->message = $order_status->message;
                $order->order_on = date("d-M-Y h:i a", strtotime($order->created_at));
                $order->deliver_on = date("d-M-Y h:i a", strtotime($order->created_at.' + 45 minute'));
            }
            return response()->json(['orders'=>$orders], 200);
        }
    }

    public function getNewOrders()
    {
        $orders = Order::where('tracking_id',null)->orderBy('id','DESC')->get();
        
        if(count($orders) <= 0){
            return response()->json(['msg'=>'No new orders found']);
        }
        else{
            foreach($orders as $order){
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
            'orders.net_amount',
            'orders.wallet_redeem',
            'orders.delivery_fee',
            'orders.vat',
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

    public function approveOrder(Request $request){
        $order_track = new OrderTrack();
        $order_track->order_id = $request->id;
        $order_track->status = 'In Progress';
        $order_track->expected_delivery_time = \Carbon\Carbon::now();

        if($order_track->save()){
            $order = Order::find($request->id);
            $order->tracking_id = $order_track->id;

            $order->save();

            $customer = Customer::findOrFail($order->customer_id);
            $user = User::findOrFail($customer->user_id);

            if (!empty($user->referal_code)) {
                $this->addReferAmountOfProduct($user->id,$order->id);
            }

            event(new OrderApproved($user));

            return response()->json(['msg'=>'Order has been approved']);
        }
    }

    public function declineOrder(Request $request)
    {
        $order_track = new OrderTrack();
        $order_track->order_id = $request->id;
        $order_track->status = 'Decline';
        $order_track->message = $request->message;
        $order_track->expected_delivery_time = \Carbon\Carbon::now();

        if($order_track->save()){
            $order = Order::find($request->id);
            $order->tracking_id = $order_track->id;

            $order->save();

            $customer = Customer::findOrFail($order->customer_id);
            $user = User::findOrFail($customer->user_id);
            $user->message = $request->message;

            if (!empty($order->wallet_redeem)) {
                $wallet = Wallet::where('user_id',$customer->user_id)->get();
                $wallet->wallet_amount = (int)$wallet->wallet_amount + (int)$order->wallet_redeem;
                $wallet->save();
            }

            event(new OrderDecline($user));

            return response()->json(['msg'=>'Order has been declined']);
        }
    }

    public function deliverOrder(Request $request)
    {
        $order_track = new OrderTrack();
        $order_track->order_id = $request->id;
        $order_track->status = 'Delivered';
        $order_track->message = $request->message;
        $order_track->expected_delivery_time = \Carbon\Carbon::now();

        if($order_track->save()){
            $order = Order::find($request->id);
            $order->tracking_id = $order_track->id;

            $order->save();

            $customer = Customer::findOrFail($order->customer_id);
            $user = User::findOrFail($customer->user_id);
            $user->message = $request->message;
            event(new OrderDecline($user));

            return response()->json(['msg'=>'Order has been delivered']);
        }
    }

    public function addReferAmountOfProduct($user_id,$order_id)
    {
        $orderItemObj = OrderItem::where('order_id',$order_id)->get();
        $userObj = User::find($user_id);
        $productObj = null;
        $referAmount = 0;

        foreach ($orderItemObj as $itemObj) {
            if (!empty($itemObj->product_variant_id)) {
                $productObj = ProductVariant::find($itemObj->product_variant_id);
            } else {
                $productObj = Product::find($itemObj->product_id);
            }
    
            if ($productObj->vendor_price > 0 && $productObj->referal_percentage > 0) {
                $amount = (($productObj->net_price - $productObj->vendor_price)/100)*$productObj->referal_percentage;
                $amount = ($amount < 0) ? 0 : $amount;
            } 

            $referAmount += $amount;
        }

        $referedBy = User::where('user_code',$userObj->referal_code)->first();

        $addToReferedBy = Wallet::where('user_id',$referedBy->id)->first();
        if (empty($addToReferedBy)) {
            $addToReferedBy = new Wallet();
            $addToReferedBy->user_id = $referedBy->id;
            $addToReferedBy->wallet_amount = $referAmount;            
        }
        else{
            $addToReferedBy->wallet_amount = (int)$addToReferedBy->wallet_amount + $referAmount;
        }
        $addToReferedBy->save();
    
    }
}
