<?php

namespace App\Http\Requests\category;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class GetCategoryRequest extends FormRequest
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
        $categories = Category::select(
            'categories.id',
            'categories.name',
            'categories.category_img',
            'categories.is_available')
        ->orderBy('sortId')->paginate(10);
        return $categories;
    }
}
