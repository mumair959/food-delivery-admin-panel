<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Pohncha Doo - Online Food & Grocery Delivery</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    @include('customer_layout.styles')

</head>

<body>

    <div class="main-wrapper">

        @include('customer_layout.header')

        @yield('content')

        @include('customer_layout.footer')

    </div>

    @include('customer_layout.scripts')

    @stack('scripts')

</body>

</html>