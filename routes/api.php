<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

/* ---------------------- Auth -------------------*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login','AuthController@login');
Route::post('register','AuthController@register');
Route::post('delete_users','DeleteUsersController@delete_users');

Route::get('setting','SettingController@setting');
Route::post('contact_us','ContactController@contact_us');
Route::get('faqs','FaqController@faqs');

Route::post('teacher', 'TeacherController@createTeacher');
Route::get('teacher', 'TeacherController@teacher');

Route::get('sessions', 'SessionController@sessions');

Route::get('lessons', 'LessonController@lessons');

Route::post('support', 'SupportController@support');


 require __DIR__ . '/Api/user_api.php';



