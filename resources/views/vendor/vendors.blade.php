@extends('layouts.admin.layout')

@section('content')
<div ng-controller="vendorCtrl" ng-init="init()">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-vcard"></i> Vendors</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Vendors</a></li>
    </ul>
  </div>
  
  <div class="card shadow" style="padding: 15px">
    <div class="row">
      <div class="col-md-10">
        <h3>Vendors</h3>
      </div>
      <div class="col-md-2">
        <a href="{{route('add_vendor')}}" class="btn btn-success">Add New <i class="fa fa-plus"></i></a>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <input type="text" class="form-control" ng-model="searchText" placeholder="Search Vendors..." />
        </div>
      </div>
    </div>
    
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th width="15%">Name</th>
          <th width="15%">Image</th>
          <th width="10%">Phone#</th>
          <th width="20%">Address</th>          
          <th width="10%">Category</th>
          <th width="10%">Available</th>
          <th width="15%">Action</th>                    
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="vendor in vendors">
          <td>@{{vendor.vendor_name}}</td>
          <td>
            <img src="{{url('/storage')}}/@{{vendor.vendor_img}}" width="120" height="80" alt="category image">
          </td>
          <td>@{{vendor.phone_num}}</td>
          <td>@{{vendor.address}}</td>          
          <td>@{{vendor.category_name}}</td>
          <td>
            <div class="toggle lg">
              <label>
                <input ng-model="vendor.is_available" ng-true-value="'1'" ng-false-value="'0'" ng-change='updateVendorAvailibility(vendor)' type="checkbox">
                <span class="button-indecator"></span>
              </label>
            </div>
          </td>
          
          <td>
            <a href="{{url('/edit_vendor/')}}/@{{vendor.id}}" class="btn btn-success">
              <i style="margin-right: 0px !important" class="fa fa-pencil"></i>
            </a>
            <a href="{{url('/vendor_details/')}}/@{{vendor.id}}" class="btn btn-danger">
              <i style="margin-right: 0px !important" class="fa fa-eye"></i>
            </a>
            <a href="{{url('vendor_images')}}/@{{vendor.id}}" class="btn btn-warning">
              <i style="margin-right: 0px !important" class="fa fa-upload"></i>
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
<script src="{{ asset('js/angular-app/controllers/vendor/vendorCtrl.js')}} "></script>

@endsection
