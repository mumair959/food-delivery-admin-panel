<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth; 
use Validator;

class AddressController extends Controller
{
    public function getAllAddress($user_id)
    {
        $customer = Customer::select('id')->where('user_id',$user_id)->first();
        $address = Address::join('customer_address as ca', 'addresses.id', '=', 'ca.address_id')
        ->where('ca.customer_id',$customer->id)->get();
        
        if(count($address) <= 0){
            return response()->json(['msg'=>'No address found']);
        }
        else{
            return response()->json(['address'=>$address], 200);
        }
    }

    public function getAddress($address_id)
    {
        $address = Address::find($address_id);

        if(!$address){
            return response()->json(['msg'=>'Address not found']);
        }
        else{
            return response()->json(['address'=>$address], 200);
        }
    }

    public function addAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'house_num' => 'required|string|max:100',
            'street' => 'required|string|max:100', 
            'area' => 'required|string|max:100', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        try{
            $customer = Customer::where('user_id',$request->user_id)->first();
            
            // Creating address
            $address = new Address();
            $address->house_num = $request->house_num;                
            $address->street = $request->street;
            $address->area = $request->area;
            $address->nearest_place = ($request->nearest_place) ? $request->nearest_place : 'N/A';
            $address->latitude = '24.765867';
            $address->longitude = '67.454677';
            
            if($address->save()){
                \DB::table('customer_address')->insert(
                    ['customer_id' => $customer->id, 'address_id' => $address->id]
                );
            }
    
            return response()->json(['msg'=>'Address added successfully'], 200);
        }
        catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()], 200);
        }
    }

    public function deleteAddress(Request $request)
    {
        $address = Address::find($request->id);

        \DB::table('customer_address')->where('address_id',$address->id)->delete();

        if($address->delete()){
            return response()->json(['msg'=>'Address deleted successfully'], 200);            
        }
        else{
            return response()->json(['msg'=>'Something went wrong'], 200);            
        }
    }

    public function updateAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'house_num' => 'required|string|max:100',
            'street' => 'required|string|max:100', 
            'area' => 'required|string|max:100', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        try{
            $customer = Customer::where('user_id',$request->user_id)->first();
            
            // Updating address
            $address = Address::find($request->id);
            $address->house_num = $request->house_num;                
            $address->street = $request->street;
            $address->area = $request->area;
            $address->nearest_place = ($request->nearest_place) ? $request->nearest_place : 'N/A';
            $address->latitude = '24.765867';
            $address->longitude = '67.454677';
            
            if($address->save()){
                return response()->json(['msg'=>'Address updated successfully'], 200);
            }
            else{
                return response()->json(['msg'=>'Something went wrong, please try again'], 401);
            }
        }
        catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()], 200);
        }
    }
}
