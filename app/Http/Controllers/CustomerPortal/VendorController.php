<?php

namespace App\Http\Controllers\CustomerPortal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\Category;
class VendorController extends Controller
{
    public function getVendorList(Request $request,$category_id)
    {
        $vendors = Vendor::where('category_id',$category_id);

        if (!empty($request->searchkey)) {
            $vendors = $vendors->where('vendor_name', 'like', '%' . $request->searchkey . '%');
        }

        $vendors = $vendors->get();

        $categories = Category::take(10)->get()->pluck('name','id');
        return view('customer_views.vendors-list',['vendors' => $vendors,'categories' => $categories]);
    }
}
