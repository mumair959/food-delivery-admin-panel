<?php

namespace App\Http\Requests\category;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class UpdateCategoryAvailibilityRequest extends FormRequest
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
        $category = Category::findOrFail(request()->category_id);
        $category->is_available = request()->is_available; 
        $category->save();

        return 'Category Availibility Update Successfully'; 
    }
}
