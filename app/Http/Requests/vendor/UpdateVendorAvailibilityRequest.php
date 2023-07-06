<?php

namespace App\Http\Requests\vendor;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Vendor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateVendorAvailibilityRequest extends FormRequest
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
        try{
            
            $vendor = Vendor::findOrFail(request()->vendor_id);
            $vendor->is_available = request()->is_available; 
            $vendor->save();

            return 'Vendor Availibility Update Successfully'; 
            
        }
        catch(\Exception $ex){
            return $ex->getMessage();
        }
    }
}
