<!DOCTYPE html>
<html lang="en" ng-app="pohnchaDooApp">
  <head>
    <title>PohnchaDoo | Admin Panel</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/toastr/angular-toastr.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    @include('layouts.admin.nav')
    
    <!-- Sidebar menu-->
    @include('layouts.admin.sidebar')
    
    <main class="app-content">
      @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.admin.footer')

    @yield('scripts')

  </body>
</html>