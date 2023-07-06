@extends('layouts.admin.layout')

@section('content')
<div ng-controller="categoryCtrl" ng-init="getCategoryInfo({{$id}})">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-vcard"></i> Edit Vendor Category</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Vendor Category</a></li>      
      <li class="breadcrumb-item"><a href="#">Edit Vendor Category</a></li>
    </ul>
  </div>

  <div class="card shadow" style="padding: 15px">
    <h3 class="tile-title">Vendor Category Form</h3>
    <hr>
    <div class="tile-body">
      <form ng-submit="updateCategory(category)">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Category Name</label>
              <input class="form-control" ng-model="category.name" type="text" placeholder="Enter Category Name">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Delivery Duration (in minutes)</label>
              <select ng-model="category.delivery_time" class="form-control" placeholder="Enter Delivery Duration"> 
                <option value="30">30</option> 
                <option value="45">45</option> 
                <option value="60">60</option> 
                <option value="75">90</option>
                <option value="75">120</option>
            </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Is Available</label>
                <select ng-model="category.is_available" class="form-control" placeholder="Select Availability"> 
                    <option value="1">Yes</option> 
                    <option value="0">No</option>     
                </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Minimum Order</label>
              <input class="form-control" ng-model="category.min_order" type="text" placeholder="Enter Min. Order">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Service Start Time</label>
              <input class="form-control" ng-model="category.service_start_time" type="text" placeholder="Enter Service Start Time">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Service End Time</label>
              <input class="form-control" ng-model="category.service_end_time" type="text" placeholder="Enter Service End Time">
            </div>
          </div>
        </div>

        <hr>

        <div class="tile-footer">
          <button class="btn btn-primary pull-right" type="submit">
            <i class="fa fa-fw fa-lg fa-check-circle"></i>Update
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
<script src="{{ asset('js/angular-app/controllers/category/categoryCtrl.js')}} "></script>

@endsection
