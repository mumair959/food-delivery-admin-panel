@extends('layouts.admin.layout')

@section('content')
<div ng-controller="voucherCtrl" ng-init="init()">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-sticky-note"></i> Vouchers List</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#"> Vouchers List</a></li>
    </ul>
  </div>
  <div class="card shadow" style="padding: 15px">
    <div class="row">
      <div class="col-md-10">
        <h3>Vouchers</h3>
      </div>
      <div class="col-md-2">
        <a href="{{route('add_voucher')}}" class="btn btn-success">Add New <i class="fa fa-plus"></i></a>
      </div> 
    </div>
    <hr>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Voucher Name</th>
          <th>Voucher Number</th>
          <th>Amount</th>
          <th>Expire At</th>          
          <th>Active</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="vouch in vouchers">
          <td>@{{vouch.voucher_name}}</td>
          <td>@{{vouch.voucher_num}}</td>
          <td>Rs. @{{vouch.amount}}</td>
          <td>@{{vouch.expire_at}}</td>          
          <td>
            <div class="toggle lg">
              <label>
                <input ng-model="vouch.active" ng-true-value="'yes'" ng-false-value="'no'" ng-change='updateVoucherStatus(vouch)' type="checkbox">
                <span class="button-indecator"></span>
              </label>
            </div>
          </td>
          <td>
            <a href="{{url('/edit_voucher/')}}/@{{vouch.id}}" class="btn btn-success">
              <i style="margin-right: 0px !important" class="fa fa-pencil"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection

@section('scripts')

<script src="{{ asset('js/angular-app/app2.js')}} "></script>
<script src="{{ asset('js/angular-app/controllers/voucher/voucherCtrl.js')}} "></script>

@endsection