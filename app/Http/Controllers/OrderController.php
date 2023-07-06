<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests\order\GetAllOrdersRequest;
use Illuminate\Support\Facades\Auth;
use App\Events\VerifyAccount;

class OrderController extends Controller
{
    public function index()
    {
        return view('order.orders');
    }

    public function getAllOrders(GetAllOrdersRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function test_sms()
    {
        event(new VerifyAccount(Auth::user()));
    }

}
