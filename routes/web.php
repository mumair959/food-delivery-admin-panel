<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*******************CUSSTOMER WEB UNAUTH ROUTES START**********************/
Route::get('/', 'CustomerPortal\CustomerController@index')->name('home');
Route::get('/customer_login', 'CustomerPortal\LoginController@login')->name('customer-login');
Route::get('/vendor_list/{category_id}','CustomerPortal\VendorController@getVendorList')->name('customer-vendor-list');
Route::get('/menu_list/{vendor_id}','CustomerPortal\MenuController@getMenuList')->name('customer-menu-list');

Route::post('/customer_post_login','CustomerPortal\LoginController@loginPost')->name('customer-post-login');
Route::post('/customer_post_register','CustomerPortal\LoginController@registerPost')->name('customer-post-register');
/*******************CUSSTOMER WEB UNAUTH ROUTES END**********************/


Route::get('/admin', function () {
    return view('auth.login');
});

Auth::routes();

Route::prefix('admin')->middleware(['checkAdmin'])->group(function () {


    /*******************
    Dashboard Routes
    ********************/

    // Dashboard Routes
    Route::get('/admin_dashboard', 'HomeController@index')->name('admin-dashboard');
    Route::get('/dashboard','HomeController@dashboardData')->name('dashboard');

    /*******************
    Customer Routes
    ********************/

    // Customers Routes
    Route::get('/customers', 'CustomerController@index')->name('customers');

    /*******************
    Push Notification Routes
    ********************/
    Route::get('/push_notification/{id?}', 'NotificationController@index')->name('push_notification');
    Route::get('/get_notification_detail/{id}', 'NotificationController@getNotification')->name('get_notification_detail');
    Route::get('/push_notifications_list', 'NotificationController@notifications_list')->name('push_notifications_list');
    Route::get('/get_old_notifications', 'NotificationController@getOldNotifications')->name('get_old_notifications');
    Route::post('/send_push_notification', 'NotificationController@sendNotification')->name('send_push_notification');

    /*******************
    Vouchers Routes
    ********************/
    Route::get('/vouchers', 'VoucherController@index')->name('vouchers');
    Route::get('/add_voucher', 'VoucherController@addVoucher')->name('add_voucher');
    Route::get('/edit_voucher/{id}', 'VoucherController@editVoucher')->name('edit_voucher');
    Route::post('/save_voucher', 'VoucherController@saveVoucher')->name('save_voucher');
    Route::post('/update_voucher', 'VoucherController@updateVoucher')->name('update_voucher');
    Route::get('/get_all_vouchers', 'VoucherController@getAllVouchers')->name('get_all_vouchers');
    Route::get('/get_voucher_detail', 'VoucherController@getVoucherDetail')->name('get_voucher_detail');
    Route::post('/change_voucher_status', 'VoucherController@changeVoucherStatus')->name('change_voucher_status');

    /*******************
    Rider Routes
    ********************/

    // Riders Routes
    Route::get('/riders', 'RiderController@index')->name('riders');

    /*******************
    Vendor Routes
    ********************/

    // Vendors Routes
    Route::get('/vendors', 'VendorController@index')->name('vendors');
    Route::get('/add_vendor', 'VendorController@addVendor')->name('add_vendor');
    Route::get('/edit_vendor/{id}', 'VendorController@editVendor')->name('edit_vendor');
    Route::get('/vendor_details/{id}', 'VendorController@vendorDetails')->name('vendor_details');
    Route::get('/get_vendor_details', 'VendorController@getVendorDetails')->name('get_vendor_details');
    Route::get('/get_all_vendors', 'VendorController@getAllVendors')->name('get_all_vendors');
    Route::get('/vendor_images/{id}', 'VendorController@vendorImages')->name('vendor_images');
    Route::get('/get_all_categories','VendorController@getAllCategories')->name('get_all_categories');
    Route::post('/save_vendor','VendorController@saveVendor')->name('save_vendor');
    Route::post('/update_vendor','VendorController@updateVendor')->name('update_vendor');
    Route::post('/update_vendor_availibility','VendorController@updateAvailibility')->name('update_vendor_availibility');
    Route::post('/upload_vendor_image','VendorController@uploadProfileImage')->name('upload_vendor_image');
    /*******************
    Category Routes
    ********************/
    Route::get('/categories', 'CategoryController@index')->name('categories');
    Route::get('/add_categories', 'CategoryController@addCategories')->name('add_categories');
    Route::get('/edit_categories/{id}', 'CategoryController@editCategories')->name('edit_categories');
    Route::get('/get_categories_data', 'CategoryController@getCategoriesData')->name('get_categories_data');
    Route::get('/get_categories', 'CategoryController@getCategories')->name('get_categories');
    Route::get('/category_images/{id}', 'CategoryController@categoryImages')->name('category_images');
    Route::post('/upload_vendor_category_image','CategoryController@uploadProfileImage')->name('upload_vendor_category_image');
    Route::post('/update_category_availibility','CategoryController@updateAvailibility')->name('update_category_availibility');
    Route::post('/update_all_categories_availibility','CategoryController@updateAllAvailibility')->name('update_all_categories_availibility');
    Route::post('/save_categories', 'CategoryController@saveCategories')->name('save_categories');
    Route::post('/update_categories', 'CategoryController@updateCategories')->name('update_categories');
    /*******************
    Product Routes
    ********************/

    // Products Routes for views
    Route::get('/products', 'ProductController@index')->name('products');
    Route::get('/add_product', 'ProductController@addProduct')->name('add_product');
    Route::get('/edit_product/{id}', 'ProductController@editProduct')->name('edit_product');
    Route::post('/save_product', 'ProductController@saveProduct')->name('save_product');
    Route::post('/update_product','ProductController@updateProduct')->name('update_product');
    Route::get('/product_details/{id}', 'ProductController@productDetails')->name('product_details');
    Route::get('/get_product_details', 'ProductController@getProductDetails')->name('get_product_details');

    // Products Routes for data
    Route::get('/get_all_products','ProductController@getAllProducts')->name('get_all_products');
    Route::get('/get_filter_products','ProductController@getFilterProducts')->name('get_filter_products');
    Route::get('/get_vedor_options','ProductController@getVendorOptions')->name('get_vedor_options');
    Route::get('/get_item_options','ProductController@getItemOptions')->name('get_item_options');
    Route::post('/change_product_status','ProductController@changeStatus')->name('change_product_status');

    /*******************
    Order Routes
    ********************/

    // Orders Routes for view
    Route::get('/orders', 'OrderController@index')->name('orders');

    // Products Routes for data
    Route::get('/get_all_orders','OrderController@getAllOrders')->name('get_all_orders');

    /*******************
    Item Routes
    ********************/
    Route::get('/item_types', 'FoodTypeController@index')->name('item_types');
    Route::get('/get_all_items','FoodTypeController@getAllTypes')->name('get_all_items');
    Route::get('/get_item_type','FoodTypeController@getItemType')->name('get_item_type');
    Route::get('/edit_item_type/{id}','FoodTypeController@editItemType')->name('edit_item_type');
    Route::get('/add_item','FoodTypeController@addItem')->name('add_item');
    Route::post('/save_item','FoodTypeController@saveItem')->name('save_item');
    Route::post('/update_item','FoodTypeController@updateItem')->name('update_item');


    Route::get('testsms', 'OrderController@test_sms');    
});
