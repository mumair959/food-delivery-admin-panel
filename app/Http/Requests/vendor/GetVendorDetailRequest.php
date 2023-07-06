<?php

namespace App\Http\Requests\vendor;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class GetVendorDetailRequest extends FormRequest
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
        $vendor = Vendor::join('categories as c','c.id','=','vendors.category_id')
        ->join('users as u','u.id','=','vendors.user_id')
        ->select(
            'vendors.id',
            'vendors.vendor_name',
            'vendors.delivery_charges',
            'vendors.min_order',
            'vendors.overhead',
            'vendors.user_id',
            'vendors.vat',
            'vendors.service_range',
            'vendors.service_start_time',
            'vendors.service_end_time',
            'vendors.latitude',
            'vendors.longitude',
            \DB::raw("(CAST(vendors.category_id AS CHAR)) as category_id"),   
            \DB::raw("(CASE WHEN (vendors.phone_num = 'N/A') THEN NULL ELSE vendors.phone_num END) as phone_num"),            
            \DB::raw("(CASE WHEN (vendors.address = 'N/A') THEN NULL ELSE vendors.address END) as address"),
            'u.first_name',
            'u.last_name',
            'u.email',
            'c.name as category_name')
        ->where('vendors.id','=',request()->id)
        ->first();

        return $vendor;
    }
}
