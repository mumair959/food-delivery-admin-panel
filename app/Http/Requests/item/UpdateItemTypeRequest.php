<?php

namespace App\Http\Requests\item;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\FoodType;
use Illuminate\Support\Facades\Auth;

class UpdateItemTypeRequest extends FormRequest
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
            'name' => 'string|required|max:20|unique:food_types',                        
        ];
    }

    public function process(){
        try{
            \DB::beginTransaction();

            $item = FoodType::findOrFail(request()->id);
            $item->name = request()->name;
            $item->save();   
            
            \DB::commit();
            
            return 'Item Type Updated Successfully';
            
        }
        catch(\Exception $ex){
            \DB::rollback();
            return $ex->getMessage();
        }
    }
}
