<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\voucher\GetVouchersRequest;
use App\Http\Requests\voucher\GetSingleVoucherRequest;
use App\Http\Requests\voucher\AddVoucherRequest;
use App\Http\Requests\voucher\UpdateVoucherRequest;
use App\Http\Requests\voucher\UpdateVoucherStatusRequest;
class VoucherController extends Controller
{
    public function index()
    {
        return view('voucher.vouchers');
    }

    public function addVoucher()
    {
        return view('voucher.add_voucher');
    }

    public function editVoucher($id)
    {
        return view('voucher.edit_voucher',['id' => $id]);
    }

    public function saveVoucher(AddVoucherRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function updateVoucher(UpdateVoucherRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function changeVoucherStatus(UpdateVoucherStatusRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function getAllVouchers(GetVouchersRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function getVoucherDetail(GetSingleVoucherRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }
}
