<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Customer Routes
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('forgot_password','API\UserController@forgot_password');
Route::post('reset_password','API\UserController@reset_password');


/*********************CUSTOMER WEB APIs START******************************/
Route::get('get_vendor_categories','API\VendorController@getVendorCategories');
Route::get('get_home_products','API\ProductController@getHomeProducts');

Route::post('customer_login', 'CustomerPortal\LoginController@loginPost');
/*********************CUSTOMER WEB APIs END******************************/

Route::get('testsms', 'API\OrderController@test_sms');

// Admin Routes
Route::post('admin_login','API\AdminController@login');

Route::group(['middleware' => 'auth:api'], function(){
    // Customer Routes
    Route::post('verify_account','API\UserController@verify');
    Route::post('resend_verification_code','API\UserController@resendVerification');    
    Route::post('logout', 'API\UserController@logout');
    Route::get('get_user_info/{user_id}','API\UserController@getUserInfo');
    Route::get('get_user_wallet/{user_id}','API\UserController@getUserWallet');    
    Route::post('edit_user_info','API\UserController@editUserInfo');
    Route::post('send_fcm_token','API\UserController@sendFcmToken');

    Route::get('get_all_address/{user_id}', 'API\AddressController@getAllAddress');
    Route::get('get_address/{address_id}', 'API\AddressController@getAddress'); 
    Route::post('add_address','API\AddressController@addAddress');
    Route::post('delete_address','API\AddressController@deleteAddress');
    Route::post('update_address','API\AddressController@updateAddress');
    
    Route::get('get_all_orders/{user_id}', 'API\OrderController@getAllOrders');
    Route::get('get_order/{order_id}', 'API\OrderController@getOrder'); 
    Route::post('place_order','API\OrderController@placeOrder');

    Route::get('get_all_vendors', 'API\VendorController@getAllVendors');
    Route::get('get_vendor_menu/{vendor_id}','API\VendorController@getVendorMenu');
    Route::get('get_menu/{vendor_id}/{category_id}','API\VendorController@getMenu');

    Route::post('apply_voucher_code','API\VoucherController@applyVoucherCode');
    
    // AdminRoutes

    Route::get('admin_get_all_orders', 'API\AdminController@getAllOrders');
    Route::get('admin_get_new_orders', 'API\AdminController@getNewOrders');
    Route::get('admin_get_cancelled_orders', 'API\AdminController@getCancelledOrders');
    Route::get('admin_get_delivered_orders', 'API\AdminController@getDeliveredOrders');
    
    Route::get('admin_get_order/{order_id}', 'API\AdminController@getOrder'); 
    Route::post('admin_approve_order','API\AdminController@approveOrder');
    Route::post('admin_decline_order','API\AdminController@declineOrder');
    Route::post('admin_deliver_order','API\AdminController@deliverOrder');
});
