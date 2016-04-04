<?php

use App\liveCMS\Models\GenericSetting as Setting;
use App\liveCMS\Models\Site;

if (! function_exists('globalParams')) {

    function globalParams($key = null, $default = false)
    {
        $params = Cache::rememberForever('global_params', function () {
            if (!Schema::hasTable('settings')) {
                return collect();
            };
     
            return Setting::get();
        });
        $params = $params->groupBy('site_id')->toArray();
        
        $siteId = site()->id;
        $params = isset($params[$siteId]) ? collect($params[$siteId])->pluck('value', 'key') : [];

        if ($key == null) {
            return $params;
        }
        
        return isset($params[$key]) ? $params[$key] : $default;
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

if (! function_exists('get')) {

    function get($postType, $identifier = null)
    {
        $namespace = 'App\\Models\\';

        $class = $namespace.studly_case(snakeToStr($postType));

        $instance = app($class);

        if ($identifier === null) {

            return $instance->get();
        }

        $show = $instance->find($identifier);

        if ($show == null) {

            $show = $instance->where('slug', $identifier)->first();
        }

        if ($show instanceof App\liveCMS\Models\PostableModel) {
            
            return $show->getContent();
        }

        return null;
    }
}

if (! function_exists('child')) {

    function child($post, $index = 0, $attribute = 'content')
    {
        if (($children = $post->children) == null || count($children) == 0) {
            
            return null;
        }

        if (is_numeric($index) && $index < count($children)) {

            $child = $children[$index] ? $children[$index] : $children[count($children) - 1];

        } else {

            $child = $children->where('slug', $index)->first();
        }

        return $child ? $child->$attribute : null;
    }
}
