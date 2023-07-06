<?php

namespace App\Http\Requests\category;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class SaveNewCategoryRequest extends FormRequest
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
            'name' => 'string|required|max:100',
            'service_start_time' => 'string|required|max:100',
            'service_end_time' => 'string|required|max:100',
            'is_available' => 'string|required',            
            'delivery_time' => 'string|required|max:10',                       
        ];
    }

    public function process(){
        try{
            \DB::beginTransaction();

            $category = new Category();

            $category->name = request()->name;
            $category->delivery_time = request()->delivery_time;
            $category->service_start_time = request()->service_start_time;
            $category->service_end_time = request()->service_end_time;            
            $category->min_order = request()->min_order;
            $category->is_available = request()->is_available;
                 
            $category->save();

            \DB::commit();
            
            return 'Category Added Successfully';
        }
        catch(\Exception $ex){
            \DB::rollback();
            return $ex->getMessage();
        }
    }
}
