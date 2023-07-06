<!-- Product Area Start -->
<div class="product-area section-pt-30" id="home_products">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3>Top Sale Products</h3>
                </div>
                <!-- Section Title End -->
            </div>
            <div class="col-lg-6 col-md-6">
                <!-- Section Title Start -->
                <div class="view-all-product text-end">
                    <a href="#">View All Products <i class="icon-chevrons-right"></i></a>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row" style="margin-bottom: 70px">
            <div v-for="product in products" class="col-md-2 col-sm-12 col-lg-2">
                <!-- Single Product Start -->
                <div class="single-product-wrap mt-10">
                    <div class="product-image">
                        <a href="#"><img src="{{asset('images/logo.png')}}" alt=""></a>
                    </div>
                    
                    <div class="product-content">
                        <div class="price-box">
                            <span class="new-price">Rs. @{{product.net_price}}</span>
                        </div>
                        <h6 class="product-name"><a href="product-details.html">@{{product.name}}</a></h6>

                        <div class="product-button-action">
                            <a href="#" class="add-to-cart">Add To Cart</a>
                        </div>
                    </div>
                </div>
                <!-- Single Product End -->
            </div>
        </div>

    </div>
</div>
<!-- Product Area Start -->