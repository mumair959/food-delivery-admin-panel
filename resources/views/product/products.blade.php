@extends('layouts.admin.layout')

@section('content')
<div ng-controller="productCtrl" ng-init="init(); getVendorOptions(); getItemOptions();">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-archive"></i> Products</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Products</a></li>
    </ul>
  </div>

  <div class="card shadow" style="padding: 15px">

    <div class="row">
      <div class="col-md-10">
        <h3>Products</h3>
      </div>
      <div class="col-md-2">
        <a href="{{route('add_product')}}" class="btn btn-success">Add New <i class="fa fa-plus"></i></a>
      </div>
    </div>

    <hr>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Vendor</label>
          <select ng-model="filter_by_vendor" ng-change="filter_product()" class="form-control"> 
              <option ng-repeat="vendor in vendorOptions" value="@{{vendor.id}}">@{{vendor.vendor_name}}</option>     
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Item Type</label>
          <select ng-model="filter_by_item" ng-change="filter_product()" class="form-control">
              <option ng-repeat="item in itemOptions" value="@{{item.id}}">@{{item.name}}</option>     
          </select>
        </div>
      </div>
    </div>
    <hr>
    
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Vendor</th>
          <th>Category</th>                    
          <th>Price</th>
          <th>Active</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="product in products">
          <td>@{{product.name}}</td>
          <td>@{{product.vendor_name}}</td>
          <td>@{{product.category}}</td>          
          <td>Rs. @{{product.net_price}}</td>
          <td>
            <div class="toggle lg">
              <label>
                <input ng-model="product.is_active" ng-true-value="1" ng-false-value="0" ng-change='updateProductStatus(product)' type="checkbox">
                <span class="button-indecator"></span>
              </label>
            </div>
          </td>
          <td>
            <a href="{{url('/edit_product/')}}/@{{product.id}}" class="btn btn-success">
              <i style="margin-right: 0px !important" class="fa fa-pencil"></i>
            </a>
            <a href="{{url('/product_details/')}}/@{{product.id}}" class="btn btn-danger">
              <i style="margin-right: 0px !important" class="fa fa-eye"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>

    <ul class="pagination justify-content-end">
      <li class="page-item">
        <a ng-if="previous != null" class="page-link" ng-click="gotoPage(previous)" ng-model="previous" href="javascript:void(0)">Previous</a>
      </li>
      <li class="page-item">
        <a ng-if="next != null" class="page-link" ng-click="gotoPage(next)" ng-model="next" href="javascript:void(0)">Next</a>
      </li>
    </ul>

  </div>
  
</div>

@endsection

@section('scripts')

<script src="{{ asset('js/angular-app/app2.js')}} "></script>
<script src="{{ asset('js/angular-app/controllers/product/productCtrl.js')}} "></script>

@endsection
