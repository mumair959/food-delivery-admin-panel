@extends('layouts.admin.layout')

@section('content')
<div ng-controller="itemCtrl" ng-init="getItemInfo({{$id}})">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-clipboard"></i> Item Types</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Item Types</a></li>
    </ul>
  </div>

  <div class="card shadow" style="padding: 15px">

    <h3 class="tile-title">Item Type Form</h3>
    <hr>
    <div class="tile-body">
        <form ng-submit="updateItem(item)">
        <div class="row">
            <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">Name</label>
                <input class="form-control" ng-model="item.name" type="text" placeholder="Enter Item Type">
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
<script src="{{ asset('js/angular-app/controllers/item_types/itemCtrl.js')}} "></script>

@endsection
