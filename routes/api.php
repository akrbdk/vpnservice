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

