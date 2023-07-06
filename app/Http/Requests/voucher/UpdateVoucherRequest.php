<?php

namespace App\Http\Requests\voucher;

use Illuminate\Support\Facades\Auth;
use App\Models\Voucher;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdateVoucherRequest extends FormRequest
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
            'voucher_name' => 'string|required',
            'voucher_num' => 'string|required',                     
            'start_at' => 'required',                     
            'expire_at' => 'required', 
            'amount' => 'required',                     
            'daily_limit' => 'required', 
            'min_order' => 'required',                                
        ];
    }

    public function process(){
        try{
            $voucher = Voucher::find(request()->id);

            $voucher->voucher_name = request()->voucher_name;
            $voucher->voucher_num = request()->voucher_num;
            $voucher->start_at = Carbon::parse(request()->start_at)->format('Y-m-d');
            $voucher->expire_at = Carbon::parse(request()->expire_at)->format('Y-m-d');
            $voucher->amount = request()->amount;
            $voucher->daily_limit = request()->daily_limit;
            $voucher->min_order = request()->min_order;
            $voucher->active = 'yes';

            $voucher->save();

            return ['success' => 'Voucher Updated Successfully'];
        }
        catch(\Exception $ex){
            return $ex->getMessage();
        }
    }
}
