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

$userSlug = globalParams('slug_userprofile', config('livecms.slugs.userprofile'));

liveCMSRouter($router, function ($router, $adminSlug, $subDomain, $subFolder) use ($userSlug) {

    $router->get('/', ['as' => 'home', function () use ($adminSlug, $subDomain, $subFolder) {
        
        // if set launching time
        $launchingDateTime = globalParams('launching_datetime') ?
            new Carbon\Carbon(globalParams('launching_datetime')) : Carbon\Carbon::now();


        // check if has home permalink
        $permalink = Permalink::withDependencies()->whereIn('permalink', ['/', ''])->first();

        // if home exist or not yet launch
        if ($permalink == null || $launchingDateTime->isFuture()) {
            return redirect('coming-soon');
        }

        $post = $permalink->postable;

        return view(theme('front', 'home'), compact('post'));
    }]);

    $router->get('coming-soon', ['as' => 'coming-soon', function () {
        return view('coming-soon');
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

    $router->group(['prefix' => $userSlug, 'namespace' => 'User', 'middleware' => 'auth'], function ($router) {

        $router->get('/', ['as' => 'admin.home', function () {
            return view('user');
        }]);

        $router->resource('profile', 'ProfileController');


    });


    // AUTH
    $router->auth();

});
