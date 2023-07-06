@extends('layouts.admin.layout')

@section('content')
<div ng-controller="productCtrl" ng-init="getDetails({{$id}})">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-archive"></i>Product Details</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Products</a></li>
      <li class="breadcrumb-item"><a href="#">Product Details</a></li>
    </ul>
  </div>

  <div class="card shadow" style="padding: 15px">
    <h2>Product Details</h2>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th ng-cloak>@{{product_details.name}}</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Category</td>
          <td ng-cloak>@{{product_details.category}}</td>
        </tr>
        <tr>
          <td>Vendor</td>
          <td ng-cloak>@{{product_details.vendor_name}}</td>
        </tr>
        <tr>
          <td>Price</td>
          <td ng-cloak>Rs. @{{product_details.net_price}}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <br>
  <div ng-if="product_details.product_variants.length > 0" class="card shadow" style="padding: 15px">
      <h2>Product Variants</h2>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Variants</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="variant in product_details.product_variants">
            <td ng-cloak>
              <span ng-if="variant.variant_val_1 != null">@{{variant.variant_val_1}}</span>
              <span ng-if="variant.variant_val_2 != null">/@{{variant.variant_val_2}}</span>
              <span ng-if="variant.variant_val_3 != null">/@{{variant.variant_val_3}}</span>
              
            </td>
            <td ng-cloak>Rs. @{{variant.net_price}}</td>
          </tr>
          
        </tbody>
      </table>
    </div>
  
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/angular-app/app2.js')}} "></script>
<script src="{{ asset('js/angular-app/controllers/product/productCtrl.js')}} "></script>
@endsection
