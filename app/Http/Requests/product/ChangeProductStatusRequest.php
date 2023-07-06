<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ChangeProductStatusRequest extends FormRequest
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
        $product = Product::findOrFail(request()->productId);
        try{
            $product->is_active = (request()->status == 1) ? '1' : '0';
            $product->save();
            return ['success' => 'Product Status Updated Successfully'];
        }
        catch(\Exception $ex){
            return ['error' => $ex->getMessage()];
        }
    }
}
