<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
liveCMSRouter($router, function ($router, $adminSlug, $subDomain, $subFolder) {

    $router->get('/', function () use ($adminSlug, $subDomain, $subFolder) {
        $launchingDateTime = globalParams('launching_datetime') ?
            new Carbon\Carbon(globalParams('launching_datetime')) : Carbon\Carbon::now();

        if ($launchingDateTime->isFuture()) {
            return redirect('coming-soon');
        }

        return 'LiveCMS '.$subDomain.' '.$subFolder;

    });

    $router->get('coming-soon', function () {
        return view('coming-soon');
    });
    

    // ADMIN AREA

    $router->group(['prefix' => $adminSlug, 'namespace' => 'Backend', 'middleware' => 'auth'], function ($router) {

        $router->controller('setting', 'SettingController');
        $router->controller('user', 'UserController');
        $router->controller('permalink', 'PermalinkController');

    });


    // AUTH
    $router->auth();

});
