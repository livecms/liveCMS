<?php

use App\Setting;

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
