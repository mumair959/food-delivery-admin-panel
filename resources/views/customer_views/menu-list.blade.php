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
                            <li class="breadcrumb-item active">Menu List</li>
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
                <div class="row">
                    <div class="col-lg-3 order-lg-1 order-2">
                        <!-- shop-sidebar-wrap start -->
                        <div class="shop-sidebar-wrap">
                            <div class="shop-box-area">

                                <!--sidebar-categores-box start  -->
                                <div class="sidebar-categores-box shop-sidebar mb-30">
                                    <h4 class="title">Menu Categories</h4>
                                    <!-- category-sub-menu start -->
                                    <div class="category-sub-menu">
                                        <ul>
                                            @foreach($foodCategories as $cat)
                                                <li class="has-sub"><a href="#">{{$cat['food_type']['name']}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- category-sub-menu end -->
                                </div>
                                <!--sidebar-categores-box end  -->

                            </div>
                        </div>
                        <!-- shop-sidebar-wrap end -->
                    </div>
                    <div class="col-lg-9 order-lg-2 order-1">

                        <!-- <div class="shop-banner mb-30">
                            <img src="assets/images/bg/shop-catergorypage.jpg" alt="Shop banner">
                        </div> -->

                        <!-- shop-product-wrapper start -->
                        <div class="shop-product-wrapper">
                            <div class="row align-itmes-center">
                                <div class="col">
                                    <!-- shop-top-bar start -->
                                    <div class="shop-top-bar">
                                        <!-- product-view-mode start -->

                                        <div class="product-mode">
                                            <!--shop-item-filter-list-->
                                            <!-- <ul class="nav shop-item-filter-list" role="tablist">
                                                <li><a class=" grid-view" data-bs-toggle="tab" href="#grid"><i class="ion-ios-keypad-outline"></i></a></li>
                                                <li class="active"><a class="active list-view" data-bs-toggle="tab" href="#list"><i class="ion-ios-list-outline"></i></a></li>
                                            </ul> -->
                                            <!-- shop-item-filter-list end -->
                                        </div>
                                        <!-- product-view-mode end -->
                                        <!-- product-short start -->
                                        <div class="product-short">
                                            <p>Sort By :</p>
                                            <select class="nice-select" name="sortby">
                                                <option value="trending">Relevance</option>
                                                <option value="sales">Name(A - Z)</option>
                                                <option value="sales">Name(Z - A)</option>
                                                <option value="rating">Price(Low > High)</option>
                                                <option value="date">Rating(Lowest)</option>
                                            </select>
                                        </div>
                                        <!-- product-short end -->
                                    </div>
                                    <!-- shop-top-bar end -->
                                </div>
                            </div>

                            <!-- shop-products-wrap start -->
                            <div class="shop-products-wrap">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="grid">
                                        <div class="shop-product-wrap">
                                            <div class="row row-8">
                                            @foreach($products as $product)
                                                <div class="product-col col-lg-3 col-md-4 col-sm-6">
                                                    <!-- Single Product Start -->
                                                    <div class="single-product-wrap mt-10">
                                                        <div class="product-image">
                                                            <a href="#"><img src="{{asset('images/logo.png')}}" alt=""></a>
                                                            <!-- <span class="onsale">Sale!</span> -->
                                                        </div>
                                                        <!-- <div class="product-button">
                                                            <a href="wishlist.html" class="add-to-wishlist"><i class="icon-heart"></i></a>
                                                        </div> -->
                                                        <div class="product-content">
                                                            <div class="price-box">
                                                                <span class="new-price">Rs. {{$product->net_price}}</span>
                                                            </div>
                                                            <h6 class="product-name"><a href="product-details.html">{{$product->name}}</a></h6>

                                                            <div class="product-button-action">
                                                                <a href="#" class="add-to-cart">Add To Cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- shop-products-wrap end -->
                        </div>
                        <!-- shop-product-wrapper end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- main-content-wrap end -->

@endsection

@push('scripts')
   
@endpush