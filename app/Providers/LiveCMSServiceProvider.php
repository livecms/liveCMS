<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;
use App\liveCMS\Illuminate\Routing\UrlGenerator;
use App\liveCMS\Illuminate\Routing\Redirector;
use App\liveCMS\Models\Site;

class LiveCMSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        site()->init();

        // Extends Url Generator
        $url = new UrlGenerator(    
            app()->make('router')->getRoutes(),
            app()->make('request')
        );
     
        app()->bind('url', function () use ($url) {
            return $url;
        });

        // EXTEND ROUTER

        $this->app['router']->group(['namespace' => 'App\liveCMS\Controllers'], function ($router) {
            require app_path('liveCMS/routes.php');
        });

        // DEBUG BAR
        $routeConfig = [
            'namespace' => 'Barryvdh\Debugbar\Controllers',
            'prefix' => site()->getCurrent()->subfolder.'/'.$this->app['config']->get('debugbar.route_prefix'),
        ];

        $this->app['router']->group($routeConfig, function ($router) {
            $router->get('open', [
                'uses' => 'OpenHandlerController@handle',
                'as' => 'debugbar.openhandler',
            ]);

            $router->get('clockwork/{id}', [
                'uses' => 'OpenHandlerController@clockwork',
                'as' => 'debugbar.clockwork',
            ]);

            $router->get('assets/stylesheets', [
                'uses' => 'AssetController@css',
                'as' => 'debugbar.assets.css',
            ]);

            $router->get('assets/javascript', [
                'uses' => 'AssetController@js',
                'as' => 'debugbar.assets.js',
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require app_path('liveCMS/helpers.php');
    }
}
