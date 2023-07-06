<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Requests\vendor\GetVendorRequest;
use App\Http\Requests\vendor\GetVendorDetailRequest;
use App\Http\Requests\vendor\GetAllCategoryRequest;
use App\Http\Requests\vendor\AddVendorRequest;
use App\Http\Requests\vendor\UpdateVendorRequest;
use App\Http\Requests\vendor\UpdateVendorAvailibilityRequest;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.vendors');
    }

    public function addVendor()
    {
        return view('vendor.add_vendor');
    }

    public function editVendor($id)
    {
        return view('vendor.edit_vendor',['id' => $id]);
    }

    public function vendorDetails($id)
    {
        return view('vendor.vendor_details',['id' => $id]);
    }

    public function getAllVendors(GetVendorRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function getAllCategories(GetAllCategoryRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function saveVendor(AddVendorRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function updateVendor(UpdateVendorRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function updateAvailibility(UpdateVendorAvailibilityRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function getVendorDetails(GetVendorDetailRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function vendorImages($id)
    {
        return view('vendor.vendor_images',['id' => $id]);
    }

    public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'vendor_profile_image' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);
  
        $file = $request->vendor_profile_image->getClientOriginalName();  
        $request->vendor_profile_image->move(public_path('storage/vendor_profile_img'), $file);
        $vendor = Vendor::find($request->vendor_id);
        $vendor->vendor_img = 'vendor_profile_img/'.$file;
        $vendor->save();

        return back()->with('success','Vendor profile image uploaded successfully');
    }

}
