@extends('layouts.admin.layout')

@section('content')
<div ng-controller="categoryCtrl" ng-init="init()">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-calendar"></i> Vendor Categories</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Vendor Categories</a></li>
    </ul>
  </div>

  <div class="card shadow" style="padding: 15px">
    <div class="row">
      <div class="col-md-10">
        <h3>Vendor Categories</h3>
      </div>
      <div class="col-md-2">
        <a href="{{route('add_categories')}}" class="btn btn-success">Add New <i class="fa fa-plus"></i></a>
      </div>
    </div>
    <hr>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th width="15%">Name</th>
          <th width="15%">Image</th>
          <th width="15%">Available
            <span class="toggle lg">
              <label>
                <input ng-model="all_available" ng-true-value="'1'" ng-false-value="'0'" ng-change='updateAllCategoryAvailibility()' type="checkbox">
                <span class="button-indecator"></span>
              </label>
            </span>
          </th>
          <th width="15%">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="category in categories">
          <td>@{{category.name}}</td>
          <td><img src="{{url('/storage')}}/@{{category.category_img}}" width="150" height="100" alt="category image"></td>
          <td>
            <div class="toggle lg">
              <label>
                <input ng-model="category.is_available" ng-true-value="'1'" ng-false-value="'0'" ng-change='updateCategoryAvailibility(category)' type="checkbox">
                <span class="button-indecator"></span>
              </label>
            </div>
          </td>
          
          <td>
            <a href="{{url('edit_categories')}}/@{{category.id}}" class="btn btn-success">
              <i style="margin-right: 0px !important" class="fa fa-pencil"></i>
            </a>

            <a href="{{url('category_images')}}/@{{category.id}}" class="btn btn-warning">
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
<script src="{{ asset('js/angular-app/controllers/category/categoryCtrl.js')}} "></script>

@endsection
