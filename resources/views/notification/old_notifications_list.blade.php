@extends('layouts.admin.layout')

@section('content')
<div ng-controller="notificationCtrl" ng-init="init()">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-bullhorn"></i> Notification</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#"> Notifications List</a></li>
    </ul>
  </div>
  <div class="card shadow" style="padding: 15px">
    <div class="row">
      <div class="col-md-9">
          <h3 class="tile-title">Notifications List</h3>
      </div>
    </div>
    
    <hr>
    <div class="tile-body">
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>Title</th>
            <th>Message</th>            
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="notification in old_notifications">
            <td>@{{notification.title}}</td>
            <td>@{{notification.message}}</td>
            <td>
              <a href="{{url('push_notification')}}/@{{notification.id}}" class="btn btn-success">
                <i style="margin-right: 0px !important" class="fa fa-eye"></i>
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
</div>

@endsection

@section('scripts')

<script src="{{ asset('js/angular-app/app2.js')}} "></script>
<script src="{{ asset('js/angular-app/controllers/notification/notificationCtrl.js')}} "></script>

@endsection