<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'guest', 'namespace' => 'Guest'], function () {

    /* ---------------------- home -------------------*/
    Route::get('home','HomeController@index');
    Route::get('product_search','HomeController@product_search');

    /* ---------------------- product -------------------*/
    Route::get('getOneProduct', 'ProductController@getOneProduct');

    /* ---------------------- offers -------------------*/
    Route::get('offers', 'OfferController@index');
    Route::get('getOneOffer', 'OfferController@getOneOffer');

    /* ---------------------- contact -------------------*/
    Route::post('contact_us','ContactController@contact_us');

});
