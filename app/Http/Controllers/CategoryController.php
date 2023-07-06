<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\category\GetCategoryRequest;
use App\Http\Requests\category\UpdateCategoryAvailibilityRequest;
use App\Http\Requests\category\UpdateAllCategoriesAvailibilityRequest;
use App\Http\Requests\category\SaveNewCategoryRequest;
use App\Http\Requests\category\UpdateCategoryRequest;
use App\Http\Requests\category\GetCategoryDetailRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.categories');
    }

    public function addCategories()
    {
        return view('category.add_categories');
    }

    public function editCategories($id)
    {
        return view('category.edit_categories',['id' => $id]);
    }

    public function getCategories(GetCategoryRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function getCategoriesData(GetCategoryDetailRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function updateAvailibility(UpdateCategoryAvailibilityRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function updateAllAvailibility(UpdateAllCategoriesAvailibilityRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function saveCategories(SaveNewCategoryRequest $request){
        $response = $request->process();
        return response()->json($response);
    }

    public function updateCategories(UpdateCategoryRequest $request){
        $response = $request->process();
        return response()->json($response);
    }

    public function categoryImages($id)
    {
        return view('category.category_images',['id' => $id]);
    }

    public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'category_profile_image' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);
  
        $file = $request->category_profile_image->getClientOriginalName();  
        $request->category_profile_image->move(public_path('storage/vendor_category_img'), $file);
        $category = Category::find($request->category_id);
        $category->category_img = 'vendor_category_img/'.$file;
        $category->save();

        return back()->with('success','Vendor category image uploaded successfully');
    }
}
