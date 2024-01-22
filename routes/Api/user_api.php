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
        Route::post('delete_image', 'AuthController@delete_image');
        Route::post('logout', 'AuthController@logout');
        Route::post('deleteAccount', 'AuthController@deleteAccount');

        /* ---------------------- track -------------------*/
        Route::post('change_track','TrackController@change_track');
        Route::get('questions','TrackController@questions');
        Route::post('store_records','TrackController@store_records');

        Route::post('absences', 'AbsenceController@create_absence');
        Route::get('absences', 'AbsenceController@list_absences');
        Route::put('absences/{absence_id}', 'AbsenceController@update_absence');
        Route::post('reports', 'MainReportController@create_report');
        Route::get('reports', 'MainReportController@list_reports');
        Route::put('reports/{report_id}', 'AbsenceController@update_report');

    });
});
