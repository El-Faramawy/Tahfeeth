<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {

    Route::post('get_code','ForgetPasswordController@get_code');
    Route::post('ConfirmCode','ForgetPasswordController@ConfirmCode');
    Route::post('UpdatePassword','ForgetPasswordController@UpdatePassword');

    Route::group(['middleware' => 'all_guards:user_api'], function () {
        Route::get('profile', 'AuthController@profile');
        Route::post('update_profile', 'AuthController@update_profile');
        Route::post('update_image', 'AuthController@update_image');
        Route::post('ask_for_coupon', 'AuthController@ask_for_coupon');
        Route::post('logout', 'AuthController@logout');
        Route::post('deleteAccount', 'AuthController@deleteAccount');

        /* ---------------------- home -------------------*/
        Route::get('home','HomeController@index');
        Route::get('product_search','HomeController@product_search');

        /* ---------------------- product -------------------*/
        Route::get('getOneProduct', 'ProductController@getOneProduct');
        Route::get('changeFavourite', 'ProductController@changeFavourite');

        /* ---------------------- offers -------------------*/
        Route::get('offers', 'OfferController@index');
        Route::get('getOneOffer', 'OfferController@getOneOffer');

        /* ---------------------- offers -------------------*/
        Route::get('changeFavourite', 'FavouriteController@changeFavourite');
        Route::get('userFavourite', 'FavouriteController@userFavourite');

        /* ---------------------- address -------------------*/
        Route::get('userAddresses', 'AddressController@index');
        Route::post('addAddress', 'AddressController@addAddress');
        Route::post('editAddress', 'AddressController@editAddress');
        Route::post('deleteAddress', 'AddressController@deleteAddress');

        /* ---------------------- notifications -------------------*/
        Route::get('notifications', 'NotificationController@notifications');
        Route::get('getNotificationsCount', 'NotificationController@getNotificationsCount');

        /* ---------------------- contact -------------------*/
        Route::post('contact_us','ContactController@contact_us');

        /* ---------------------- orders -------------------*/
        Route::get('coupon', 'OrderController@coupon');
        Route::get('branches', 'OrderController@branches');
        Route::get('openOrClosed', 'OrderController@checkOpenOrClosed');
        Route::post('store_order', 'OrderController@store_order');
        Route::get('order_details', 'OrderController@order_details');
        Route::get('current_orders', 'OrderController@current_orders');
        Route::get('previous_orders', 'OrderController@previous_orders');
        Route::post('cancel_order', 'OrderController@cancel_order');

    });
});

//// ****************** payment*****************************
//Route::get('payment','Payment\PaymentController@index')->name('payment')
//    ->middleware('all_guards:user_api');
