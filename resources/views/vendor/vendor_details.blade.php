@extends('layouts.admin.layout')

@section('content')
<div ng-controller="vendorCtrl" ng-init="get_vendor_detail({{$id}})">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-vcard"></i> Vendor Details</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Vendor</a></li>      
      <li class="breadcrumb-item"><a href="#">Vendor Details</a></li>
    </ul>
  </div>

  <div class="card shadow" style="padding: 15px">
    <h2>Vendor Details</h2>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th ng-cloak>@{{vendorDetail.vendor_name}}</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Category</td>
          <td ng-cloak>@{{vendorDetail.category_name}}</td>
        </tr>
        <tr>
          <td>Address</td>
          <td ng-cloak>@{{vendorDetail.address}}</td>
        </tr>
        <tr>
          <td>Phone#</td>
          <td ng-cloak>@{{vendorDetail.phone_num}}</td>
        </tr>
      </tbody>
    </table>
  </div>

</div>

@endsection

@section('scripts')

<script src="{{ asset('js/angular-app/app2.js')}} "></script>
<script src="{{ asset('js/angular-app/controllers/vendor/vendorCtrl.js')}} "></script>

@endsection
