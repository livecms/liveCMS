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

        $articleSlug        = globalParams('slug_article', config('livecms.slugs.article'));
        $staticpageSlug     = globalParams('slug_staticpage', config('livecms.slugs.staticpage'));
        $teamSlug           = globalParams('slug_team', config('livecms.slugs.team'));

        $router->resource('category', 'CategoryController');
        $router->resource('tag', 'TagController');
        $router->resource($articleSlug, 'ArticleController');
        $router->resource($staticpageSlug, 'StaticPageController');
        $router->resource($teamSlug, 'TeamController');

    });

    // FRONTEND
    $router->group(['namespace' => 'Frontend'], function ($router) {
        $router->get('{arg0?}/{arg1?}/{arg2?}/{arg3?}/{arg4?}/{arg5?}', 'PageController@routes');
    });

});
