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

        ################################### user_notes ##########################################
        Route::resource('user_notes','UserNotesController');
        Route::post('multi_delete_user_notes','UserNotesController@multiDelete')->name('user_notes.multiDelete');

        ################################### teachers ##########################################
        Route::resource('teachers','TeacherController');
        Route::get('block_teacher/{id}','TeacherController@block')->name('teachers.block');
        Route::post('multi_delete_teachers','TeacherController@multiDelete')->name('teachers.multiDelete');

        ################################### faqs ##########################################
        Route::resource('faqs','FaqController');
        Route::post('multi_delete_faqs','FaqController@multiDelete')->name('faqs.multiDelete');

        ################################### reports ##########################################
        Route::resource('reports','ReportController');
        Route::get('periodic_reports','ReportController@periodic_reports')->name('periodic_reports.index');
        Route::post('multi_delete_reports','ReportController@multiDelete')->name('reports.multiDelete');

        ################################### absence ##########################################
        Route::resource('absence','AbsenceController');
        Route::post('multi_delete_absence','AbsenceController@multiDelete')->name('absence.multiDelete');
        Route::get('change_absence/{id}','AbsenceController@change_absence')->name('change_absence');

        ################################### reduction_reports ##########################################
        Route::resource('reduction_reports','ReductionReportsController');
        Route::post('multi_delete_reduction_reports','ReductionReportsController@multiDelete')->name('reduction_reports.multiDelete');
        Route::get('change_reduction_reports/{id}','ReductionReportsController@change_reduction_reports')->name('change_reduction_reports');

        ################################### change_save_amount ##########################################
        Route::resource('change_save_amount','ChangeSaveAmountController');
        Route::post('multi_delete_change_save_amount','ChangeSaveAmountController@multiDelete')->name('change_save_amount.multiDelete');
        Route::get('change_report_save_amount/{id}','ChangeSaveAmountController@change_save_amount')->name('change_save_amount');

        ################################### sessions ##########################################
        Route::resource('sessions','SessionController');
        Route::post('multi_delete_sessions','SessionController@multiDelete')->name('sessions.multiDelete');

        ################################### lessons ##########################################
        Route::resource('lessons','LessonController');
        Route::post('multi_delete_lessons','LessonController@multiDelete')->name('lessons.multiDelete');

        ################################### lesson_subject ##########################################
        Route::resource('lesson_subject','LessonSubjectController');
        Route::post('multi_delete_lesson_subject','LessonSubjectController@multiDelete')->name('lesson_subject.multiDelete');

        ################################### groups ##########################################
        Route::resource('groups','GroupController');
        Route::post('multi_delete_groups','GroupController@multiDelete')->name('groups.multiDelete');

        ################################### contacts ##########################################
        Route::resource('contacts','ContactController');
        Route::get('replay_contact/{id}','ContactController@replay')->name('replay_contact');
        Route::post('post_replay_contact','ContactController@post_replay')->name('post_replay_contact');
        Route::post('multi_delete_contacts','ContactController@multiDelete')->name('contacts.multiDelete');

        ################################### supports ##########################################
        Route::resource('supports','SupportController');
        Route::post('multi_delete_supports','SupportController@multiDelete')->name('supports.multiDelete');

        ################################### settings ##########################################
        Route::resource('settings','SettingController');

        ################################### questions ##########################################
        Route::resource('questions','QuestionController');


    });//end Middleware Admin



    Route::fallback(function () {
        return redirect('admin/home');
    });

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
