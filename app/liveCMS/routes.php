<?php

use App\liveCMS\Models\Permalink;

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

    $router->get('coming-soon', ['as' => 'coming-soon', function () {
        return view('coming-soon');
    }]);

    $router->get('redirect', ['as' => 'redirect', function () {
        return redirect()->to(request()->get('to'));
    }]);

    // ADMIN AREA

    $router->group(['prefix' => $adminSlug, 'namespace' => 'Backend', 'middleware' => 'auth'], function ($router) {
        
        $router->get('/', ['as' => 'admin.home', function () {
            return view('admin.home');
        }]);

        $router->resource('permalink', 'PermalinkController');
        $router->resource('setting', 'SettingController');
        $router->resource('user', 'UserController');
        $router->resource('site', 'SiteController');

    });

    // PROFILE AREA

    $userSlug = globalParams('slug_userhome', config('livecms.slugs.userhome'));
    $router->group(['prefix' => $userSlug, 'namespace' => 'User', 'middleware' => 'auth'], function ($router) {

        $router->get('/', ['as' => 'user.home', function () {
            $bodyClass        = 'skin-blue sidebar-mini sidebar-collapse';

            return view('user', compact('bodyClass'));
        }]);

        $router->resource('profile', 'ProfileController');


    });


    // AUTH
    $router->auth();

    $router->get('register', function () {
        return redirect()->route('user.home');
    });

});
