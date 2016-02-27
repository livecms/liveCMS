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
$adminSlug = globalParams('slug_admin', config('livecms.slugs.admin'));

$router->get('/', function () use ($adminSlug) {
    $launchingDateTime = globalParams('launching_datetime') ?
        new Carbon\Carbon(globalParams('launching_datetime')) : Carbon\Carbon::now();

    if ($launchingDateTime->isFuture()) {
        return redirect('coming-soon');
    }

    return redirect($adminSlug);

});

$router->get('coming-soon', function () {
    return view('coming-soon');
});

$router->get('/home', function () use ($adminSlug) {
    return redirect($adminSlug);
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

$router->group(['middleware' => ['web']], function ($router) use ($adminSlug) {

    $router->group(['prefix' => $adminSlug, 'namespace' => 'Backend', 'middleware' => 'auth'], function ($router) {
        $router->get('/', function () {
            return view('admin.home');
        });

        $router->controller('kategori', 'KategoriController');
        $router->controller('tag', 'TagController');
        $router->controller('artikel', 'ArtikelController');
        $router->controller('staticpage', 'StaticPageController');
        $router->controller('setting', 'SettingController');
        $router->controller('user', 'UserController');
        $router->controller('permalink', 'PermalinkController');
    });

    $router->auth();

    $router->group(['prefix' => '/', 'namespace' => 'Frontend'], function ($router) {
        $router->get('{arg0?}/{arg1?}/{arg2?}/{arg3?}/{arg4?}/{arg5?}', 'PageController@routes');
    });

});
