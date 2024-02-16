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

        Route::get('user_teachers', 'TeacherController@userTeachers');

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

        Route::post('reduction_report', 'ReductionReportController@create_reduction_report');
        Route::get('reduction_report', 'ReductionReportController@list_reduction_report');

        Route::post('change_save_amount', 'ChangeSaveAmountController@change_save_amount');
        Route::get('change_save_amount', 'ChangeSaveAmountController@list_save_amount');

    });
});
