@extends('layouts.admin.layout')

@section('content')
<div ng-controller="vendorCtrl" ng-init="getAllCategories()">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-vcard"></i> Add Vendor</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Vendor</a></li>      
      <li class="breadcrumb-item"><a href="#">Add Vendor</a></li>
    </ul>
  </div>

  <div class="card shadow" style="padding: 15px">
    <h3 class="tile-title">Vendor Form</h3>
    <hr>
    <div class="tile-body">
      <form ng-submit="addVendor(vendor)">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">First Name</label>
              <input class="form-control" ng-model="vendor.first_name" type="text" placeholder="Enter User First Name">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Last Name</label>
              <input class="form-control" ng-model="vendor.last_name" type="text" placeholder="Enter User Last Name">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Email Address</label>
              <input class="form-control" ng-model="vendor.email" type="text" placeholder="Enter Email Address">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Vendor Name</label>
              <input class="form-control" ng-model="vendor.vendor_name" type="text" placeholder="Enter Vendor Name">
            </div>
          </div>
        </div>
        
        <hr>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Phone#</label>
              <input class="form-control" ng-model="vendor.phone_num" type="text" placeholder="Enter Phone Number">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Category</label>
              <select ng-model="vendor.category_id" class="form-control" placeholder="Select Category"> 
                  <option ng-repeat="category in categories" value="@{{category.id}}">@{{category.name}}</option>     
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Delivery Charges</label>
              <input class="form-control" ng-model="vendor.delivery_charges" type="text" placeholder="Enter Delivery Charges">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Delivery Charges Overhead</label>
              <input class="form-control" ng-model="vendor.overhead" type="text" placeholder="Enter Charges Overhead">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Minimum Order</label>
              <input class="form-control" ng-model="vendor.min_order" type="text" placeholder="Enter Minimum Order">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">VAT</label>
              <input class="form-control" ng-model="vendor.vat" type="text" placeholder="Enter VAT">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Address</label>
              <input class="form-control" ng-model="vendor.address" type="text" placeholder="Enter Vendor Address">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Latitude</label>
              <input class="form-control" ng-model="vendor.latitude" type="text" placeholder="Enter Latitude">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Longitude</label>
              <input class="form-control" ng-model="vendor.longitude" type="text" placeholder="Enter Longitude">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Service Range (Km)</label>
              <input class="form-control" ng-model="vendor.service_range" type="text" placeholder="Enter Service Range">
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Service Start Time</label>
              <input class="form-control" ng-model="vendor.service_start_time" type="text" placeholder="Select Service Start Time">
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Service End Time</label>
              <input class="form-control" ng-model="vendor.service_end_time" type="text" placeholder="Select Service End Time">
            </div>
          </div>

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

</div>

@endsection

@section('scripts')

<script src="{{ asset('js/angular-app/app2.js')}} "></script>
<script src="{{ asset('js/angular-app/controllers/vendor/vendorCtrl.js')}} "></script>

@endsection
