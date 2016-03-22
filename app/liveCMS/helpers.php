<?php

use App\Setting;
use App\liveCMS\Models\Site;

if (! function_exists('globalParams')) {

    function globalParams($key = null, $default = false)
    {
        $globalParams = Cache::rememberForever('global_params', function () {
            if (!Schema::hasTable('settings')) {
                return [];
            };
     
            return Setting::lists('value', 'key');
        });
        
        if ($key == null) {
            return $globalParams;
        }
        
        return isset($globalParams[$key]) ? $globalParams[$key] : $default;
    }
}

if (! function_exists('snakeToStr')) {
    
    function snakeToStr($snake)
    {
        return implode(' ', explode('_', $snake));
    }
}

if (! function_exists('site')) {

    function site()
    {
        return app(Site::class)->getCurrent();
    }
}

if (! function_exists('liveCMSRouter')) {

    function liveCMSRouter($router, callable $callback)
    {
        $adminSlug  = globalParams('slug_admin', config('livecms.slugs.admin'));
        $site       = site()->getCurrent();
        $host       = $site->getHost();
        $path       = $site->getPath();
        $domain     = $site->getDomain();
        $subDomain  = $site->subdomain;
        $subFolder  = $site->subfolder;

        $notFound = $site->id == null && $host != $domain;
        $redirectToIfNotFound = '//'.$domain.'/'.$path;

        if ($notFound) {
            $router->any($path, function () use ($redirectToIfNotFound) {
                return redirect()->away($redirectToIfNotFound);
            });
        }

        // ROUTING

        $router->group(
            ['domain' => $host, 'middleware' => 'web', 'prefix' => $subFolder],
            function ($router) use ($adminSlug, $subDomain, $subFolder, $callback) {
                $callback($router, $adminSlug, $subDomain, $subFolder);
            }
        );
    }
}

if (! function_exists('theme')) {

    function theme($type, $location = 'template')
    {
        $types = 'themes.'.config('livecms.themes.'.$type);
        $location = '.'.$location;

        if (view()->exists($view = $type.$location)) {

            return $view;
        }

        return $types.$location;
    }
}
