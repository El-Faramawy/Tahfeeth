<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin'], function () {
    Route::get('login','AuthController@index')->name('login');
    Route::post('post_login','AuthController@login')->name('post_login');

    Route::group(['middleware' => 'admin'], function () {

        Route::get('logout','AuthController@logout')->name('logout');

        Route::get('/',function (){
            return redirect('admin/home');
        })->name('/');
        Route::get('home','HomeController@index')->name('home');

        ################################### Profile ##########################################
        Route::get('profile','AdminController@profile')->name('profile');
        Route::post('update-profile','AdminController@update_profile')->name('profile.update');

        ################################### Admins ##########################################
        Route::resource('admins','AdminController');
        Route::post('multi_delete_admins','AdminController@multiDelete')->name('admins.multiDelete');

        ################################### users ##########################################
        Route::resource('users','UserController');
        Route::get('block_user/{id}','UserController@block')->name('users.block');
        Route::get('user_records/{id}','UserController@user_records')->name('user_records');
        Route::post('change_user_track','UserController@change_user_track')->name('change_user_track');
        Route::post('change_track','UserController@change_track')->name('change_track');
        Route::post('multi_delete_users','UserController@multiDelete')->name('users.multiDelete');

        ################################### teachers ##########################################
        Route::resource('teachers','TeacherController');
        Route::get('block_teacher/{id}','TeacherController@block')->name('teachers.block');
        Route::post('multi_delete_teachers','TeacherController@multiDelete')->name('teachers.multiDelete');

        ################################### faqs ##########################################
        Route::resource('faqs','FaqController');
        Route::post('multi_delete_faqs','FaqController@multiDelete')->name('faqs.multiDelete');

        ################################### sessions ##########################################
        Route::resource('sessions','SessionController');
        Route::post('multi_delete_sessions','SessionController@multiDelete')->name('sessions.multiDelete');

        ################################### groups ##########################################
        Route::resource('groups','GroupController');
        Route::post('multi_delete_groups','GroupController@multiDelete')->name('groups.multiDelete');

        ################################### contacts ##########################################
        Route::resource('contacts','ContactController');
        Route::get('replay_contact/{id}','ContactController@replay')->name('replay_contact');
        Route::post('post_replay_contact','ContactController@post_replay')->name('post_replay_contact');
        Route::post('multi_delete_contacts','ContactController@multiDelete')->name('contacts.multiDelete');

        ################################### settings ##########################################
        Route::resource('settings','SettingController');

        ################################### questions ##########################################
        Route::resource('questions','QuestionController');


    });//end Middleware Admin



//    Route::fallback(function () {
//        return redirect('admin/home');
//    });

    Route::get('/migrate', function() {
        Artisan::call('migrate ');
        my_toaster('migrated');
        return 'migrated';
    });

    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');
        return '<h1> cache cleared</h1>';
    });
});//end Prefix
