<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use function foo\func;

class VendorController extends Controller
{
    public function getAllVendors(Request $request)
    {
        $vendors = Vendor::where(['category_id' => $request->id, 'is_available' => '1'])
        ->withCount(['orderItems'])->with(['products' => function($query){
            return $query->select(\DB::raw('round(( discount/price * 100 ),0) as discount_percent, vendor_id'))
            ->orderBy('discount', 'desc')->get();
        }])->orderBy('order_items_count','DESC')->get();
        
        if(count($vendors) <= 0){
            return response()->json(['msg'=>'No vendors found']);
        }
        else{
            $vendorList = [];
            foreach ($vendors as $index => $vendor) {
                $vendor->max_discount = $vendor->products->pluck('discount_percent');
                if (($vendor->latitude != 'N/A' && $vendor->longitude != 'N/A')) {
                    $vendor->delivery_charges = $this->distance($request->latitude,$request->longitude,$vendor->latitude,$vendor->longitude,$vendor->delivery_charges,$vendor->overhead);    
                    $validRange = $this->serviceRangeValid($request->latitude,$request->longitude,$vendor->latitude,$vendor->longitude,$vendor->service_range);    
                    $validTimming = $this->serviceTimeValid($vendor);
                    if ($validRange && $validTimming) {
                        $vendorList[] = $vendor;
                    }
                }
                else{
                    $vendorList[] = $vendor;
                }
                unset($vendor->products);
            }
            return response()->json(['vendors'=>$vendorList], 200);
        }
    }

    public function getVendorCategories()
    {
        $category = Category::select('id','name','is_available','delivery_time','min_order','category_img','service_start_time','service_end_time')
        ->withCount('vendors')->orderBy('sortId')->get();

        $all_categories = Category::count();
        $disable_categories = Category::where('is_available','0')->count();
        
        if(count($category) <= 0){
            return response()->json(['msg'=>'No categories found']);
        }
        elseif ($all_categories == $disable_categories) {
            return response()->json(['categories' => []], 200);
        }
        else{
            $categoryList = [];
            foreach ($category as $index => $cat) {
                $validTimming = $this->serviceTimeValid($cat);
                if ($validTimming) {
                    $categoryList[] = $cat;
                }
            }
            return response()->json(['categories'=>$categoryList], 200);
        }
    }

    public function getVendorMenu($vendor_id)
    {
        $category = Product::select('ft.id','ft.name')
        ->where('vendor_id',$vendor_id)
        ->join('food_types as ft', 'ft.id', '=', 'products.food_id')
        ->groupBy('ft.id','ft.name')->get();
        
        $menu = Product::select('products.id','name','products.description','products.measure_unit','products.measure_rate',
        'products.vendor_id','products.food_id','products.is_active','products.variant_1','products.price','products.discount',
        'products.variant_2','products.variant_3','products.has_variants','products.net_price','v.delivery_charges')
        ->join('vendors as v','v.id','=','products.vendor_id')
        ->where([
            ['vendor_id','=',$vendor_id],
            ['food_id','=',$category[0]->id],
            ['is_active','=','1']
        ])->with(['productVariants' => function($query)
        {
            $query->select('id','product_id','variant_val_1','variant_val_2','variant_val_3','price','discount','net_price');
        }])->orderBy('id')->get();

        return response()->json(['category'=>$category,'menu'=>$menu], 200);
    }

    public function getMenu($vendor_id,$category_id)
    {
        $menu = Product::select('products.id','products.name','products.description',
        'products.measure_unit','products.measure_rate','products.vendor_id','products.food_id','products.is_active',
        'products.variant_1','products.variant_2','products.variant_3','products.has_variants',
        'products.net_price','products.price','products.discount','v.delivery_charges')
        ->join('vendors as v','v.id','=','products.vendor_id')
        ->where([
            ['vendor_id','=',$vendor_id],
            ['food_id','=',$category_id],
            ['is_active','=','1']
        ])->with(['productVariants' => function($query)
        {
            $query->select('id','product_id','variant_val_1','variant_val_2','variant_val_3','price','discount','net_price');
        }])->orderBy('id')->get();

        return response()->json(['menu'=>$menu], 200);
    }

    function distance($lat1, $lon1, $lat2, $lon2, $delivery_charges, $overhead) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
          return $delivery_charges;
        }
        else {
          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $kilometers = $miles * 1.609344;

          $kilometers = $kilometers - 2;

          if ($kilometers > 0) {
            $delivery_charges = $delivery_charges + (ceil($kilometers)*$overhead);
          }
      
          return $delivery_charges; 
        }
    }

    function serviceRangeValid($lat1, $lon1, $lat2, $lon2, $vendorService){
        
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $kilometers = $miles * 1.609344;

        return $kilometers <= $vendorService;
    }

    public function serviceTimeValid($vendor)
    {
        $currentTime = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $startTime = \Carbon\Carbon::now()->format('Y-m-d').' '.$vendor->service_start_time.':00';
        $endTime = \Carbon\Carbon::now()->format('Y-m-d').' '.$vendor->service_end_time.':00';

        if(strtotime($currentTime) > strtotime($startTime) && strtotime($currentTime) < strtotime($endTime) ) {
            return true;
        } else {
            return false;
        }
    }
}
