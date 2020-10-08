<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
   // $router->get('/dashboard', 'dashboardController@index')->name('dashboard');
    $router->get('/chartsData', 'HomeController@chartsData')->name("home.chartsData");

    //$router->resource('/admin/dashboard',dashboardController::class);

    $router->resources([
        //客戶

    ]);

});
