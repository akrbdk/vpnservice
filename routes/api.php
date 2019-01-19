<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['verifyAccount']], function () {
    //////////// Here all your routes

    ////// Example:
    Route::get('myProtectedRoute', array('uses' => 'MyController@MyControllerFunction'))->name('myActionName');
});


Route::post('v1/account/login', 'API\UserController@login');
Route::get('v1/account/login', 'API\UserController@login');

Route::post('v1/account/create', 'API\UserController@register');
Route::get('v1/account/create', 'API\UserController@register');

Route::post('v1/account/details', 'API\UserController@checkToken');
Route::get('v1/account/details', 'API\UserController@checkToken');

//Route::group(['middleware' => 'auth:api'], function(){
//    Route::post('v1/account/details', 'API\UserController@checkToken');
//    Route::get('v1/account/details', 'API\UserController@checkToken');
//});

Route::post('v1/server/create', 'API\ServerController@create');
Route::get('v1/server/create', 'API\ServerController@create');

Route::post('v1/server/info', 'API\ServerController@info');
Route::get('v1/server/info', 'API\ServerController@info');

Route::post('v1/server/connect', 'API\ServerController@connect');
Route::get('v1/server/connect', 'API\ServerController@connect');

Route::post('v1/server/list', 'API\ServerController@serverList');
Route::get('v1/server/list', 'API\ServerController@serverList');

Route::post('v1/user/verify_conn', 'API\ServerController@verifyConn');
Route::get('v1/user/verify_conn', 'API\ServerController@verifyConn');


Route::post('v1/plan/current', 'API\PlansController@getUserPlan');
Route::get('v1/plan/current', 'API\PlansController@getUserPlan');
