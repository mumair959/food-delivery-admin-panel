<header class="header">
    <!-- Header Top Start -->
    <div class="header-top-area d-none d-lg-block text-color-white bg-gren border-bm-1">

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-top-settings">

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="top-info-wrap text-end">
                        @if(Auth::check())
                        <ul class="my-account-container">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Cart</a></li>
                            <li><a href="#">Checkout</a></li>
                        </ul>
                        @else
                        <ul class="my-account-container">
                            <li><a href="{{route('customer-login')}}">Login</a></li>
                            <li><a href="{{route('customer-login')}}">Sign Up</a></li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Header Top End -->

    <!-- haeader Mid Start -->
    <div class="haeader-mid-area bg-gren border-bm-1 d-none d-lg-block ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-5">
                    <div class="logo-area">
                        <a href="#"><img src="{{asset('customer/images/logo/logo.png')}}" alt="" width="120"></a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="search-box-wrapper">
                        <div class="search-box-inner-wrap">
                            <div class="search-title text-white d-flex">
                            </div>
                            <form class="search-box-inner">
                
                                <div class="search-field-wrap">
                                    <input type="text" class="search-field" placeholder="Search product...">

                                    <div class="search-btn">
                                        <button><i class="icon-search"></i></button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="customer-wrap green-bg">
                        <div class="single-costomer-box">
                            <div class="single-costomer">
                                <p><i class="icon-check-circle"></i><span>Quick Delivery</span></p>
                            </div>
                        </div>

                        <div class="single-costomer-box">
                            <div class="single-costomer">
                                <p><i class="icon-lock"></i><span>Safe Payment</span></p>
                            </div>
                        </div>

                        <div class="single-costomer-box">
                            <div class="single-costomer">
                                <p><i class="icon-bell"></i><span>24/7 Support</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- haeader Mid End -->

    <!-- haeader bottom Start -->
    <div class="haeader-bottom-area bg-gren header-sticky">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9 d-none d-lg-block">

                    <div class="main-menu-area white_text">
                        <!--  Start Mainmenu Nav-->
                        <nav class="main-navigation">
                            <ul>
                                <li class="active"><a href="#">Home</a></li>
                                <li><a href="#">Vendors <i class="fa fa-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        @foreach($categories as $id=>$category)
                                            <li><a href='{{route("customer-vendor-list",["category_id" => $id])}}'>{{$category}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </nav>

                    </div>
                </div>

                <div class="col-5 col-md-6 d-block d-lg-none">
                    <div class="logo"><a href="#"><img src="{{asset('customer/images/logo/logo.png')}}" alt=""></a></div>
                </div>

                <div class="col-lg-3 col-md-6 col-7">
                    <div class="right-blok-box text-white d-flex">

                        @if(Auth::check())
                        <div class="shopping-cart-wrap">
                            <a href="#"><i class="icon-shopping-bag2"></i><span class="cart-total">2</span> <span class="cart-total-amunt">$260</span></a>
                            <ul class="mini-cart">
                                <li class="cart-item">
                                    <div class="cart-image">
                                        <a href="single-product.html"><img alt="" src="{{asset('customer/images/product/product-01.jpg')}}"></a>
                                    </div>
                                    <div class="cart-title">
                                        <a href="single-product.html">
                                            <h4>Product Name 01</h4>
                                        </a>
                                        <div class="quanti-price-wrap">
                                            <span class="quantity">1 ×</span>
                                            <div class="price-box"><span class="new-price">$130.00</span></div>
                                        </div>
                                        <a class="remove_from_cart" href="#"><i class="icon-x"></i></a>
                                    </div>
                                </li>
                                <li class="cart-item">
                                    <div class="cart-image">
                                        <a href="single-product.html"><img alt="" src="{{asset('customer/images/product/product-02.jpg')}}"></a>
                                    </div>
                                    <div class="cart-title">
                                        <a href="single-product.html">
                                            <h4>Product Name 03</h4>
                                        </a>
                                        <div class="quanti-price-wrap">
                                            <span class="quantity">1 ×</span>
                                            <div class="price-box"><span class="new-price">$130.00</span></div>
                                        </div>
                                        <a class="remove_from_cart" href="#"><i class="icon-trash icons"></i></a>
                                    </div>
                                </li>
                                <li class="subtotal-box">
                                    <div class="subtotal-title">
                                        <h3>Sub-Total :</h3><span>$ 260.99</span>
                                    </div>
                                </li>
                                <li class="mini-cart-btns">
                                    <div class="cart-btns">
                                        <a href="cart.html">View cart</a>
                                        <a href="checkout.html">Checkout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        @endif

                        <div class="mobile-menu-btn d-block d-lg-none">
                            <div class="off-canvas-btn">
                                <a href="#"><img src="{{asset('customer/images/icon/bg-menu.png')}}" alt=""></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- haeader bottom End -->


    <!-- off-canvas menu start -->
    <aside class="off-canvas-wrapper">
        <div class="off-canvas-overlay"></div>
        <div class="off-canvas-inner-content">
            <div class="btn-close-off-canvas">
                <i class="icon-x"></i>
            </div>

            <div class="off-canvas-inner">

                <div class="search-box-offcanvas">
                    <form>
                        <input type="text" placeholder="Search product...">
                        <button class="search-btn"><i class="icon-search"></i></button>
                    </form>
                </div>

                <!-- mobile menu start -->
                <div class="mobile-navigation">

                    <!-- mobile menu navigation start -->
                    <nav>
                        <ul class="mobile-menu">
                        
                            <li><a href="#">Home</a></li>
                            <li class="menu-item-has-children"><a href="#">Vendors</a>
                                <ul class="dropdown">
                                    @foreach($categories as $id=>$category)
                                        <li><a href="#">{{$category}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav>
                    <!-- mobile menu navigation end -->
                </div>
                <!-- mobile menu end -->



                <!-- offcanvas widget area start -->
                <div class="offcanvas-widget-area">
                    <div class="top-info-wrap text-start text-black">
                        <h5>My Account</h5>
                        <ul class="offcanvas-account-container">
                            <li><a href="#">My account</a></li>
                            <li><a href="#">Cart</a></li>
                            <li><a href="#">Checkout</a></li>
                        </ul>
                    </div>

                </div>
                <!-- offcanvas widget area end -->
            </div>
        </div>
    </aside>
    <!-- off-canvas menu end -->


</header>