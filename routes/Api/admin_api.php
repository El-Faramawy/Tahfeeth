<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin_api', 'namespace' => 'Admin'], function () {



    Route::group(['middleware' => 'all_guards:admin_api'], function () {
        Route::post('logout', 'AuthController@logout');

        /* ---------------------- notifications -------------------*/
        Route::get('notifications', 'NotificationController@notifications');
        Route::get('getNotificationsCount', 'NotificationController@getNotificationsCount');

        /* ---------------------- orders -------------------*/
        Route::get('current_orders', 'OrderController@current_orders');
        Route::get('previous_orders', 'OrderController@previous_orders');
        Route::get('order_details', 'OrderController@order_details');
        Route::post('update_order_status', 'OrderController@update_order_status');
        Route::post('notification_to_order_user', 'OrderController@notification_to_order_user');

        /* ---------------------- close orders -------------------*/
        Route::post('close_orders', 'SettingController@close_orders');

    });
});

