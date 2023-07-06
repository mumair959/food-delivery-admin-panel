<?php

namespace App\Http\Requests\voucher;

use Illuminate\Support\Facades\Auth;
use App\Models\Voucher;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVoucherStatusRequest extends FormRequest
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
            'voucherId' => 'required',
            'status' => 'string|required',                                                    
        ];
    }

    public function process(){
        try{
            $voucher = Voucher::find(request()->voucherId);
            $voucher->active = request()->status;

            $voucher->save();

            return ['success' => 'Voucher Status Updated Successfully'];
        }
        catch(\Exception $ex){
            return $ex->getMessage();
        }
    }
}
