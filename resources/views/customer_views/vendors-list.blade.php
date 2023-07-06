@extends('customer_layout.master')

@section('content')

   <!-- breadcrumb-area start -->
   <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list">
                            <li class="breadcrumb-item"><a href="#l">Home</a></li>
                            <li class="breadcrumb-item active">Vendor List</li>
                        </ul>
                        <!-- breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb-area end -->


        <!-- main-content-wrap start -->
        <div class="main-content-wrap shop-page section-ptb">
            <div class="container">

                <!--single-widget start  -->
                <div class="single-widget search-widget mb-30">
                    <form action="{{route('customer-vendor-list',['category_id' => \Request::segment(2)])}}">
                        <div class="form-input">
                            <input type="text" name="searchkey" placeholder="Search... ">
                            <button class="button-search" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <!--single-widget start end -->

                <div class="row">

                    <div class="col-lg-12 order-lg-1 order-1">

                        <div class="blog-wrapper">
                            <div class="row">
                                @foreach($vendors as $vend)
                                <div class="col-lg-4">
                                    <!-- single-blog-wrap Start -->
                                    <div class="single-blog-wrap mb-40">
                                        <div class="latest-blog-image">
                                            <a href="#">
                                                @if($vend->vendor_img)
                                                    <img src="{{asset('/storage/'.$vend->vendor_img)}}" heigth="300" alt="">
                                                @else
                                                    <img src="{{asset('/storage/vendor_profile_img/banner.png')}}" heigth="300" alt="">
                                                @endif
                                            </a>
                                            <div class="post-category-tag">
                                                <ul>
                                                    <li><a href="#">{{$vend->vendor_name}}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="latest-blog-content mt-20">
                                            
                                            <div class="blog-read-more">
                                                <a href="{{route('customer-menu-list',['vendor_id' => $vend->id])}}" class="btn btn-full-width btn-block">Goto Menu</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-blog-wrap End -->
                                </div>
                                @endforeach

                            </div>
      
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- main-content-wrap end -->

@endsection

@push('scripts')
   
@endpush