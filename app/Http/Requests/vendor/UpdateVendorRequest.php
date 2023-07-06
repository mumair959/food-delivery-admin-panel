<?php

namespace App\Http\Requests\vendor;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Vendor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateVendorRequest extends FormRequest
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
            'first_name' => 'string|required|max:100',
            'last_name' => 'string|required|max:100',            
            'address' => 'string|required|max:600',
            'email' => 'email|required|max:150',
            'phone_num' => 'string|required|max:20|regex:/^[0-9]+$/',                        
        ];
    }

    public function process(){
        try{
            \DB::beginTransaction();

            $user = User::findOrFail(request()->user_id);

            $user->first_name = request()->first_name;
            $user->last_name = request()->last_name;    
            
            if($user->save()){
                $vendor = Vendor::findOrFail(request()->id);

                $vendor->vendor_name = request()->vendor_name;
                $vendor->phone_num = request()->phone_num;
                $vendor->address = request()->address;
                $vendor->category_id = (int)request()->category_id;
                $vendor->delivery_charges = (int)request()->delivery_charges;
                $vendor->min_order = (int)request()->min_order;
                $vendor->vat = (int)request()->vat;
                $vendor->service_range = (float)request()->service_range;
                $vendor->service_start_time = request()->service_start_time;
                $vendor->service_end_time = request()->service_end_time;
                $vendor->latitude = request()->latitude;
                $vendor->longitude = request()->longitude;
                $vendor->overhead = (int)request()->overhead;
                $vendor->admin_comission_rate = 10;
                
                $vendor->save();
                
                \DB::commit();

                return 'Vendor Update Successfully';
            }
            
        }
        catch(\Exception $ex){
            \DB::rollback();
            return $ex->getMessage();
        }
    }
}
