<?php

namespace App\Http\Requests\vendor;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class GetVendorRequest extends FormRequest
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
        $vendors = Vendor::join('categories as c','c.id','=','vendors.category_id')
        ->select(
            'vendors.id',
            'vendors.vendor_name',
            'vendors.vendor_img',
            'vendors.is_available',
            'vendors.phone_num',
            'vendors.overhead',
            'vendors.min_order',
            'vendors.address',
            'vendors.latitude',
            'vendors.longitude',
            'c.name as category_name')
        ->when(request()->searchText, function ($query) { 
            return $query->where('vendor_name','like','%'.request()->searchText.'%');
        })
        ->paginate(10);
        return $vendors;
    }
}
