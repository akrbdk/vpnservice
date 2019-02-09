<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['verifyAccount']], function () {
    //авторизация
    Route::post('v1/account/login', 'API\UserController@login');
    Route::get('v1/account/login', 'API\UserController@login');
    //верификация юзера
    Route::post('v1/account/details', 'API\UserController@checkToken');
    Route::get('v1/account/details', 'API\UserController@checkToken');


    //create new server
    Route::post('v1/server/create', 'API\ServerController@create');
    Route::get('v1/server/create', 'API\ServerController@create');
    //get server info
    Route::post('v1/server/info', 'API\ServerController@info');
    Route::get('v1/server/info', 'API\ServerController@info');
    //connect to vpn server
    Route::post('v1/server/connect', 'API\ServerController@connect');
    Route::get('v1/server/connect', 'API\ServerController@connect');
    //list of servers
    Route::post('v1/server/list', 'API\ServerController@serverList');
    Route::get('v1/server/list', 'API\ServerController@serverList');
    //verify user conn
    Route::post('v1/user/verify_conn', 'API\ServerController@verifyConn');
    Route::get('v1/user/verify_conn', 'API\ServerController@verifyConn');

    //get user plan
    Route::post('v1/plan/current', 'API\PlansController@getUserPlan');
    Route::get('v1/plan/current', 'API\PlansController@getUserPlan');
});

//get apps list
Route::post('v1/app/list', 'API\AppInfoController@getAppInfoList');
Route::get('v1/app/list', 'API\AppInfoController@getAppInfoList');
