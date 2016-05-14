<?php

use App\liveCMS\Models\GenericSetting as Setting;
use App\liveCMS\Models\Site;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Collection;

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

if (! function_exists('isInCurrentRoute')) {

    function isInCurrentRoute($part)
    {
        return starts_with(request()->route()->getName(), $part);
    }
}

if (! function_exists('canRead')) {

    function canRead($routeName)
    {
        $route = Route::getRoutes()->getByName($routeName);
        
        if ($route == null) {
            return null;
        }

        $action = $route->getAction();

        list($controller, $action) = explode('@', $action['controller']);

        return app($controller)->getControllerModel()->allowsUserRead(auth()->user());
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

    function get($postType, $identifier = null, $number = 1, array $where = [], array $fields = ['*'], $order = 'asc', $orderBy = 'id')
    {
        $namespace = 'App\\Models\\';

        $class = $namespace.studly_case(snakeToStr($postType));

        $instance = app($class);


        if ($identifier === null) {

            return $instance->where($where)->take($number)->orderBy($orderBy, $order)->get($fields);
        }

        $show = is_array($identifier) ? $instance->whereIn($instance->getKeyName(), $identifier)->take($number)->orderBy($orderBy, $order)->get($fields) : $instance->find($identifier);

        if (!$show) {
            $show = $instance->where('slug', $identifier)->first($fields);
        }

        if ($show instanceof App\liveCMS\Models\PostableModel) {
            return $show->getContent();
        }

        if ($show instanceof Collection) {
            return $show;
        }

        return null;
    }
}

if (! function_exists('getCategory')) {

    function getCategory($category, $postType = 'article', $number = 10, array $fields = ['*'], $order = 'asc', $orderBy = 'id')
    {
        $namespace = 'App\\Models\\';

        $class = $namespace.studly_case(snakeToStr($postType));

        $ids = app($class)->whereHas('categories', function ($query) use ($category) {
            $query->where(function ($query) use ($category) {
                $table = $query->getModel()->getTable();
                $query->where($table.'.category', $category)->orWhere($table.'.slug', $category);
            });
        })->pluck('id')->toArray();

        return get($postType, $ids, $number, [], $fields, $order, $orderBy);
    }
}

if (! function_exists('getTag')) {

    function getTag($tag, $postType = 'article', $number = 10, array $fields = ['*'], $order = 'asc', $orderBy = 'id')
    {
        $namespace = 'App\\Models\\';

        $class = $namespace.studly_case(snakeToStr($postType));

        $ids = app($class)->whereHas('tags', function ($query) use ($tag) {
            $query->where(function ($query) use ($tag) {
                $table = $query->getModel()->getTable();
                $query->where($table.'.tag', $tag)->orWhere($table.'.slug', $tag);
            });
        })->pluck('id')->toArray();

        return get($postType, $ids, $number, [], $fields, $order, $orderBy);
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

if (! function_exists('dataImplode')) {

    function dataImplode($data, $attribute)
    {
        return rtrim($data->pluck($attribute)->implode(', '), ', ');
    }
}
