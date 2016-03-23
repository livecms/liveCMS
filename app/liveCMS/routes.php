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
        
        // if set launching time
        $launchingDateTime = globalParams('launching_datetime') ?
            new Carbon\Carbon(globalParams('launching_datetime')) : Carbon\Carbon::now();


        // check if has home permalink
        $permalink = \App\liveCMS\Models\Permalink::whereIn('permalink', ['/', ''])->first();

        // if home exist or not yet launch
        if ($permalink == null || $launchingDateTime->isFuture()) {
            return redirect('coming-soon');
        }

        return view(theme('front', 'home'), $permalink);
    });

    $router->get('coming-soon', function () {
        return view('coming-soon');
    });
    

    // ADMIN AREA

    $router->group(['prefix' => $adminSlug, 'namespace' => 'Backend', 'middleware' => 'auth'], function ($router) {

        $router->resource('setting', 'SettingController');
        $router->resource('user', 'UserController');
        $router->resource('permalink', 'PermalinkController');

    });


    // AUTH
    $router->auth();

});
