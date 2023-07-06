<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;

class AddProductRequest extends FormRequest
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
            'name' => 'string|required|max:100',
            'description' => 'string|nullable|max:250',
            'vendor_id' => 'required',
            'food_id' => 'required',
            'measure_unit' => 'required',            
            'price' => 'required',
            'is_active' => 'sometimes',
            'has_variants' => 'sometimes',
            'variant_1' => 'sometimes',
            'variant_2' => 'sometimes',
            'variant_3' => 'sometimes',
            'variant_val_1' => 'required_with:variant_1',
            'variant_val_2' => 'required_with:variant_2',
            'variant_val_3' => 'required_with:variant_3',
        ];
    }

    public function process(){
        try{
            \DB::beginTransaction();

            $product = new Product();

            $product->name = request()->name;
            $product->description = request()->description;
            $product->is_active = (request()->is_active == 1) ? '1' : '0';
            $product->variant_1 = (request()->variant_1) ? request()->variant_1 : null;
            $product->variant_2 = (request()->variant_2) ? request()->variant_2 : null;
            $product->variant_3 = (request()->variant_3) ? request()->variant_3 : null;
            $product->is_composite = '0';
            $product->has_variants = (request()->has_variant == 1) ? '1' : '0';
            $product->price = request()->price;
            $product->vendor_price = request()->vendor_price;
            $product->referal_percentage = request()->referal_percentage;
            $product->discount = request()->discount;
            $product->net_price = request()->net_price;
            $product->measure_unit = (request()->measure_unit !== 'None') ? request()->measure_unit : null;
            $product->measure_rate = (float)request()->measure_rate;
            $product->vendor_id = request()->vendor_id;
            $product->food_id = request()->food_id;
            
            if($product->save()){
                foreach (request()->allVariants as $key => $variant) {
                    $allVar = explode('/',$variant['variant_name']);
                    $productVariant = new ProductVariant();
                    $productVariant->product_id = $product->id;
                    $productVariant->sku = 'none';             
                    $productVariant->variant_val_1 = (isset($allVar[0])) ? $allVar[0] : null;
                    $productVariant->variant_val_2 = (isset($allVar[1])) ? $allVar[1] : null;
                    $productVariant->variant_val_3 = (isset($allVar[2])) ? $allVar[2] : null;
                    $productVariant->price = $variant['price']; 
                    $productVariant->vendor_price = $variant['vendor_price'];             
                    $productVariant->referal_percentage = $variant['referal_percentage'];
                    $productVariant->discount_type = 'None';             
                    $productVariant->discount = $variant['discount'];           
                    $productVariant->net_price = $variant['net_price'];  
                    $productVariant->quantity = 0;                    
                    
                    $productVariant->save();
                }
                
                \DB::commit();

                return 'Product Added Successfully';
            }
            
        }
        catch(\Exception $ex){
            \DB::rollback();
            return $ex->getMessage();
        }
    }
}
