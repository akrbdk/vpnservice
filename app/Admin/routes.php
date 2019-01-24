<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('plans_table', PlansTableController::class);
    $router->resource('site_users', SiteUsersController::class);
    $router->resource('server_infos', ServerInfosController::class);
    $router->resource('contacts_info', ContactUSController::class);
    $router->resource('apps_info', AppsInfoController::class);

});
