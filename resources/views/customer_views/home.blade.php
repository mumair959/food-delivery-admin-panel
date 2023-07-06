@extends('customer_layout.master')

@section('content')

    @include('customer_layout.banner')

    @include('customer_layout.categories')

    @include('customer_layout.slider')

    @include('customer_layout.slider_2')

    @include('customer_layout.product_area_1')

@endsection

@push('scripts')
    <script src="{{asset('js/vuejs/components/homecategories.js')}}"></script>
    <script src="{{asset('js/vuejs/components/homeproducts.js')}}"></script>    
@endpush