<!-- Categories Item Warap Start -->
<div class="categories-item-warap section-pt-30 section-pb">
    <div class="container">
        <div class="row" id="home_categories">
            <div v-for="category in categories" class="col-lg-2 col-md-4 col-sm-4 col-12">
                <!-- single-categories-item Start -->
                <div class="single-categories-item mt-30">
                    <div class="cat-item-image">
                        <a href="#"><img width="150" height="130" v-bind:src="img_url + category.category_img" alt=""></a>
                    </div>
                    <div class="categories-title">
                        <h6><a href="#" v-clock>@{{category.name}}</a></h6>
                        <p>@{{category.vendors_count}} Vendors</p>
                    </div>
                </div>
                <!-- single-categories-item End -->
            </div>

        </div>
    </div>
</div>
<!-- Categories Item Warap End -->