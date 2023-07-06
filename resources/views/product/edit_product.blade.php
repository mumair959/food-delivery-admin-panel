@extends('layouts.admin.layout')

@section('content')
<div ng-controller="productCtrl" ng-init="getVendorOptions(); getItemOptions(); getDetails({{$id}})">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-archive"></i>Edit Products</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Products</a></li>
      <li class="breadcrumb-item"><a href="#">Edit Product</a></li>
    </ul>
  </div>

  <div class="card shadow" style="padding: 15px">

    <h3 class="tile-title">Product Form</h3>
    <hr>
    <div class="tile-body">
      <form ng-submit="updateProduct(product)">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Name</label>
              <input class="form-control" ng-model="product.name" type="text" placeholder="Enter Product Name">
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <label class="control-label">Description</label>
              <input class="form-control" ng-model="product.description" type="text" placeholder="Enter Product Description">
            </div>
          </div>
        </div>  
        
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Vendor</label>
              <select ng-model="product.vendor_id" class="form-control"> 
                  <option ng-repeat="vendor in vendorOptions" value="@{{vendor.id}}">@{{vendor.vendor_name}}</option>     
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Item Type</label>
              <select ng-model="product.food_id" class="form-control">
                  <option ng-repeat="item in itemOptions" value="@{{item.id}}">@{{item.name}}</option>     
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="sel1">Measure Unit</label>
              <select ng-model="product.measure_unit" class="form-control">
                <option value="Kg">Kg</option>
                <option value="Gm">Gm</option>
                <option value="Dozen">Dozen</option>
                <option value="Gaddi">Gaddi</option>
                <option value="None">None</option>                
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="sel1">Measure Rate</label>
              <select ng-model="product.measure_rate" class="form-control">
                <option value="0.25">0.25</option>
                <option value="0.5">0.50</option>
                <option value="1">1.00</option>   
                <option value="50.00">50.00</option>            
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Vendor Price</label>
              <input class="form-control" ng-model="product.vendor_price" type="number" placeholder="Enter Product Vendor Price">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Referal Percentage</label>
              <input class="form-control" ng-model="product.referal_percentage" type="number" placeholder="Enter Product Referal Percentatage">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Price</label>
              <input class="form-control" ng-model="product.price" type="number" placeholder="Enter Product Price">
            </div>
          </div>

        </div>          

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Discount</label>
              <input class="form-control" ng-model="product.discount" type="number" placeholder="Enter Discount">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Net Price</label>
              <input class="form-control" ng-model="product.net_price" type="number" placeholder="Enter Product Net Price">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="animated-checkbox" style="margin-top: 30px">
              <label>
                <input ng-model="product.is_active" ng-true-value="1" ng-true-value="0" type="checkbox"><span class="label-text">Is Active</span>
              </label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="animated-checkbox" style="margin-top: 30px">
              <label>
                <input type="checkbox" ng-model="product.has_variant" ng-true-value="1" ng-true-value="0">
                <span class="label-text">Has Variants</span>
              </label>
            </div>
          </div>
        </div>

        <hr>

        <div ng-show="product.has_variant == 1" class="col-md-12" style="margin-top: 30px">          
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="25%">Variants</th>
                <th width="15%">Vendor Price</th>
                <th width="15%">Referal Percentage</th>                
                <th width="15%">Price (Rs.)</th>
                <th width="15%">Discount (Rs.)</th>
                <th width="15%">Net Price (Rs.)</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="variant in product.product_variants">
                <td ng-cloak>
                  <span ng-if="variant.variant_val_1 != null">@{{variant.variant_val_1}}</span>
                  <span ng-if="variant.variant_val_2 != null">/@{{variant.variant_val_2}}</span>
                  <span ng-if="variant.variant_val_3 != null">/@{{variant.variant_val_3}}</span>
                  
                </td>
                <td ng-cloak> 
                    <input class="form-control" style="width: 70%" ng-model="variant.vendor_price" type="number">
                </td>
                <td ng-cloak> 
                    <input class="form-control" style="width: 70%" ng-model="variant.referal_percentage" type="number">
                </td>
                <td ng-cloak> 
                    <input class="form-control" style="width: 70%" ng-model="variant.price" type="number">
                </td>
                <td ng-cloak> 
                  <input class="form-control" style="width: 70%" ng-model="variant.discount" type="number">
                </td>
                <td ng-cloak> 
                    <input class="form-control" style="width: 70%" ng-model="variant.net_price" type="number">
                </td>
              </tr>
              
            </tbody>
          </table>
           
        </div>

        <hr>

        <div class="tile-footer">
          <button class="btn btn-primary pull-right" type="submit">
            <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
          </button>
          <button class="btn btn-secondary pull-right mr-1" type="button">
            <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
          </button>
        </div>

      </form>
    </div>
    
  </div>
  
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/angular-app/app2.js')}} "></script>
<script src="{{ asset('js/angular-app/controllers/product/productCtrl.js')}} "></script>
<script>
  // Add product page scripts
  $(".variantsVal").select2({
    placeholder: "Enter Variant Value",
    tags: true
  });
</script>
@endsection
