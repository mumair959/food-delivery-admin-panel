@extends('layouts.admin.layout')

@section('content')
<div ng-controller="itemCtrl" ng-init="init()">
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

    <div class="row">
      <div class="col-md-10">
        <h3>Item Types</h3>
      </div>
      <div class="col-md-2">
        <a href="{{route('add_item')}}" class="btn btn-success">Add New <i class="fa fa-plus"></i></a>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <input type="text" class="form-control" ng-model="searchText" placeholder="Search Items..." />
        </div>
      </div>
    </div>

    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="item in items">
          <td>@{{item.name}}</td>
          
          <td>
            <a href="{{url('edit_item_type')}}/@{{item.id}}" class="btn btn-success">
              <i style="margin-right: 0px !important" class="fa fa-pencil"></i>
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
<script src="{{ asset('js/angular-app/controllers/item_types/itemCtrl.js')}} "></script>

@endsection
