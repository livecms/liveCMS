<?php

use App\Setting;

if (! function_exists('globalParams')) {

    function globalParams($key = null, $default = false)
    {
        if (!Schema::hasTable('settings')) {
            return $default;
        };

        $globalParams = Cache::rememberForever('global_params', function() {
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
        return ucwords(implode(' ', explode('_', $snake)));
    }
}
