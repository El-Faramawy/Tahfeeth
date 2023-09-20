<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\NewOrder;
// use App\Events\MyEvent;
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

Route::group(['middleware'=>'all_guards'],function(){

    /* ---------------------- orders -------------------*/

});


//require __DIR__ . '/Api/delivery_api.php';
//
 require __DIR__ . '/Api/user_api.php';
// require __DIR__ . '/Api/admin_api.php';
// require __DIR__ . '/Api/guest_api.php';



