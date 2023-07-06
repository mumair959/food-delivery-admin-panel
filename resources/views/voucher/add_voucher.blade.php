@extends('layouts.admin.layout')

@section('content')
<div ng-controller="voucherCtrl">
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
      <div class="col-md-12">
        <h3>Add Voucher</h3>
      </div> 
    </div>
    <hr>
    
    <div class="tile-body">
        <form ng-submit="addVoucher(voucher)">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Voucher Name</label>
                <input class="form-control" ng-model="voucher.voucher_name" type="text" placeholder="Enter Voucher Name">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Voucher Number</label>
                <input class="form-control" ng-model="voucher.voucher_num" type="text" placeholder="Enter Voucher Number">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Amount</label>
                <input class="form-control" ng-model="voucher.amount" type="text" placeholder="Enter Amount">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Daily Limit</label>
                <input class="form-control" ng-model="voucher.daily_limit" type="text" placeholder="Enter Daily Limit">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Minimum Order</label>
                <input class="form-control" ng-model="voucher.min_order" type="text" placeholder="Enter Minimum Order">
              </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label">Start At</label>
                  <input class="form-control" ng-model="voucher.start_at" type="date" placeholder="Select Start Date">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Expire At</label>
                    <input class="form-control" ng-model="voucher.expire_at" type="date" placeholder="Select Expire Date">
                </div>
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

@endsection

@section('scripts')

<script src="{{ asset('js/angular-app/app2.js')}} "></script>
<script src="{{ asset('js/angular-app/controllers/voucher/voucherCtrl.js')}} "></script>

@endsection