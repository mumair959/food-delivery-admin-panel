<?php

namespace App\Http\Requests\item;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\FoodType;
use Illuminate\Support\Facades\Auth;

class GetAllItemTypeRequest extends FormRequest
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
        if (request()->searchText) {
            $items = FoodType::where('name','like','%'.request()->searchText.'%')->paginate(10);
        } else {
            $items = FoodType::paginate(10);
        }
        
        return $items;
    }
}
