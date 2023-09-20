<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'delivery', 'namespace' => 'Delivery'], function () {

//    Route::post('register', 'AuthController@register');

    Route::group(['middleware' => 'all_guards:delivery_api'], function () {
        Route::get('profile', 'AuthController@profile');
        Route::post('update_profile', 'AuthController@update_profile');
        Route::post('logout', 'AuthController@logout');


        /* ---------------------- notifications -------------------*/
        Route::get('notifications', 'NotificationController@notifications');
        Route::get('getNotificationsCount', 'NotificationController@getNotificationsCount');

        /* ---------------------- contact -------------------*/
        Route::post('contact_us','ContactController@contact_us');

        /* ---------------------- orders -------------------*/
        Route::get('order_details', 'OrderController@order_details');
        Route::get('new_orders', 'OrderController@new_orders');
        Route::get('current_orders', 'OrderController@current_orders');
        Route::get('previous_orders', 'OrderController@previous_orders');
        Route::post('end_order', 'OrderController@end_order');
        Route::post('accept_order', 'OrderController@accept_order');

    });
});
