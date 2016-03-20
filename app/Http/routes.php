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
        $router->get('/', ['as' => 'admin.home', function () {
            return view('admin.home');
        }]);

        $router->controller('kategori', 'KategoriController');
        $router->controller('tag', 'TagController');
        $router->controller('artikel', 'ArtikelController');
        $router->controller('staticpage', 'StaticPageController');

    });
    
    $router->auth();

    $router->group(['prefix' => '/', 'namespace' => 'Frontend'], function ($router) {
        $router->get('{arg0?}/{arg1?}/{arg2?}/{arg3?}/{arg4?}/{arg5?}', 'PageController@routes');
    });
});
