@extends('layouts.admin.layout')

@section('content')
<div>
  <div class="app-title">
    <div>
      <h1><i class="fa fa-vcard"></i> Add Vendor Image</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Vendor</a></li>      
      <li class="breadcrumb-item"><a href="#">Add Vendor Image</a></li>
    </ul>
  </div>

  <div class="card shadow" style="padding: 15px">
    <h3 class="tile-title">Vendor Image Form</h3>
    <hr>
    <div class="tile-body">

      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
      </div>
      @endif
  
      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      <form action="{{ route('upload_vendor_image') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="form-control" name="vendor_id" type="hidden" value="{{$id}}">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Vendor Image</label>
              <input class="form-control" name="vendor_profile_image" type="file" required>
            </div>
          </div>

        </div>

        <hr>

        <div class="tile-footer">
          <button class="btn btn-primary pull-right" type="submit">
            <i class="fa fa-fw fa-lg fa-check-circle"></i>Add
          </button>
          <button class="btn btn-secondary pull-right mr-1" type="button">
            <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
          </button>
        </div>

      </form>
    </div>
    
  </div>
  </div>

</div>

@endsection
