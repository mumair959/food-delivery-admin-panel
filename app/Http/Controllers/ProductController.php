<?php

namespace App\Http\Controllers;
use App\Http\Requests\product\GetProductRequest;
use App\Http\Requests\product\FilterProductsRequest;
use App\Http\Requests\product\GetVendorOptionsRequest;
use App\Http\Requests\product\GetItemOptionsRequest;
use App\Http\Requests\product\ChangeProductStatusRequest;
use App\Http\Requests\product\GetProductDetailsRequest;
use App\Http\Requests\product\AddProductRequest;
use App\Http\Requests\product\UpdateProductRequest;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.products');
    }

    public function getAllProducts(GetProductRequest $request){
        $response = $request->process();
        return response()->json($response);
    }

    public function getFilterProducts(FilterProductsRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function getVendorOptions(GetVendorOptionsRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function getItemOptions(GetItemOptionsRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function addProduct()
    {
        return view('product.add_product');
    }

    public function editProduct($id)
    {
        return view('product.edit_product',['id' => $id]);
    }

    public function saveProduct(AddProductRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function updateProduct(UpdateProductRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function changeStatus(ChangeProductStatusRequest $request){
        $response = $request->process();
        return response()->json($response);
    }

    public function productDetails($id)
    {
        return view('product.product_detail',['id' => $id]);
    }

    public function getProductDetails(GetProductDetailsRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }
}
