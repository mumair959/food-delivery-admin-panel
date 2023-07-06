@extends('layouts.admin.layout')

@section('content')
<div ng-controller="notificationCtrl" ng-init="getNotificationDetail({{$id}})">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-bullhorn"></i> Send Notification</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#"> Send Notification</a></li>
    </ul>
  </div>
  <div class="card shadow" style="padding: 15px">
    <div class="row">
      <div class="col-md-9">
          <h3 class="tile-title">Notification</h3>
      </div>
      <div class="col-md-2">
        <a href="{{route('push_notifications_list')}}" class="btn btn-success">View Old Notifications <i class="fa fa-eye"></i></a>
      </div>
    </div>
    
    <hr>
    <div class="tile-body">
      <form ng-submit="sendNotification(notification)">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Title</label>
              <input class="form-control" type="text" ng-model="notification.title" placeholder="Enter Title" required>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <label class="control-label">Message</label>
              <input class="form-control" type="text" ng-model="notification.message" placeholder="Enter Message" required>
            </div>
          </div>
        </div>

        <hr>

        <div class="tile-footer">
          <button class="btn btn-primary pull-right" type="submit">
            <i class="fa fa-fw fa-lg fa-check-circle"></i>Send
          </button>
        </div>

      </form>
    </div>
    
  </div>
</div>

@endsection

@section('scripts')

<script src="{{ asset('js/angular-app/app2.js')}} "></script>
<script src="{{ asset('js/angular-app/controllers/notification/notificationCtrl.js')}} "></script>

@endsection