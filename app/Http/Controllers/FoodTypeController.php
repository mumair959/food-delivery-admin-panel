<?php

namespace App\Http\Controllers;

use App\FoodType;
use Illuminate\Http\Request;
use App\Http\Requests\item\GetAllItemTypeRequest;
use App\Http\Requests\item\AddItemTypeRequest;
use App\Http\Requests\item\UpdateItemTypeRequest;
use App\Http\Requests\item\GetItemTypeRequest;

class FoodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('item_type.items');
    }

    public function addItem()
    {
        return view('item_type.add_item');
    }

    public function editItemType($id)
    {
        return view('item_type.edit_item',['id' => $id]);
    }

    public function getItemType(GetItemTypeRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function getAllTypes(GetAllItemTypeRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function saveItem(AddItemTypeRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function updateItem(UpdateItemTypeRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

}
