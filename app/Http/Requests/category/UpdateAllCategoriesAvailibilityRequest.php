<?php

namespace App\Http\Requests\category;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class UpdateAllCategoriesAvailibilityRequest extends FormRequest
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
        if (request()->is_available == '1') {
            Category::where('is_available','0')->update(['is_available' => '1']);
        } else {
            Category::where('is_available','1')->update(['is_available' => '0']);
        }

        return 'All Categories Availibility Update Successfully'; 
    }
}
