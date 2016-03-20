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


    // FRONTEND
    $router->group(['prefix' => '/', 'namespace' => 'Frontend'], function ($router) {
        $router->get('{arg0?}/{arg1?}/{arg2?}/{arg3?}/{arg4?}/{arg5?}', 'PageController@routes');
    });
    
});
