@extends('layouts.admin.layout')

@section('content')
<div ng-controller="dashboardCtrl" ng-init="init()">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    </ul>
  </div>

  {{-- Second Row --}}
  <div class="row">
    <div class="col-md-4">
      <div class="widget-small primary"><i class="icon fa fa-star fa-3x"></i>
        <div class="info">
          <h4>Top Vendor</h4>
          <p><b ng-cloak>@{{top_vendor}}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="widget-small info"><i class="icon fa fa-star fa-3x"></i>
        <div class="info">
          <h4>Top Customer</h4>
          <p><b ng-cloak>@{{top_customer}}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="widget-small warning"><i class="icon fa fa-star fa-3x"></i>
        <div class="info">
          <h4>Top Product</h4>
          <p><b ng-cloak>@{{top_product}}</b></p>
        </div>
      </div>
    </div>
  </div>

  {{-- First Row --}}
  <div class="row">
    <div class="col-md-3">
      <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Clients</h4>
          <p><b ng-cloak>@{{customers}}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="widget-small info"><i class="icon fa fa-vcard fa-3x"></i>
        <div class="info">
          <h4>Vendors</h4>
          <p><b ng-cloak>@{{vendors}}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="widget-small warning"><i class="icon fa fa-bicycle fa-3x"></i>
        <div class="info">
          <h4>Riders</h4>
          <p><b ng-cloak>@{{riders}}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="widget-small danger"><i class="icon fa fa-cart-arrow-down fa-3x"></i>
        <div class="info">
          <h4>Orders</h4>
          <p><b ng-cloak>@{{orders}}</b></p>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection

@section('scripts')

<script src="{{ asset('js/angular-app/app2.js')}} "></script>
<script src="{{ asset('js/angular-app/controllers/dashboard/dashboardCtrl.js')}} "></script>

@endsection
