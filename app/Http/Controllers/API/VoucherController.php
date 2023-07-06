<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{
    public function applyVoucherCode(Request $request)
    {
        $voucher = Voucher::where('voucher_num',$request->voucher_code)->first();

        if (!empty($voucher)) {
            $voucherExpiry = \Carbon\Carbon::now()->lte($voucher->expire_at);
        }
        
        if (empty($voucher)) {
            return response()->json(['error' => 'Invalid promocode entered']);
        }
        else if ($voucher->min_order > $request->order_amount) {
            return response()->json(['error' => 'Order amount should be atleast Rs.'.$voucher->min_order.' to avail this promocode']);
        }
        else if($voucher->active == 'no'){
            return response()->json(['error' => 'Promocode is not active']);
        }
        else if(!$voucherExpiry){
            return response()->json(['error' => 'Promocode has been expired']);
        }
        else{
            $voucherUsedByUser = \DB::table('user_vouchers')
            ->where('user_id',$request->user_id)
            ->where('voucher_id',$voucher->id)
            ->first();

            $voucherUsedToday = \DB::table('user_vouchers')
            ->whereDate('created_at',\Carbon\Carbon::now())
            ->where('voucher_id',$voucher->id)
            ->count();

            if (!empty($voucherUsedByUser)) {
                return response()->json(['error' => 'Promocode already availed']);
            }
            if ($voucherUsedToday >= (int)$voucher->daily_limit) {
                return response()->json(['error' => 'This Promotion Bucket is full today you can try again later or place normal order without using promo code, Thank you']);
            }
        }
        return response()->json(['voucher' => $voucher]);
    }
}
