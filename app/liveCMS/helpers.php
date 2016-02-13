<?php

use App\Setting;

if (! function_exists('globalParams')) {

    function globalParams($key = null, $default = false)
    {
        $global_params = Cache::rememberForever('global_params', function() {
            return Setting::lists('value', 'key');
        });
        
        if ($key == null) {
            return $global_params;
        }
        
        return isset($global_params[$key]) ? $global_params[$key] : $default;
    }
}

if (! function_exists('snakeToStr')) {
    
    function snakeToStr($snake)
    {
        return ucwords(implode(' ', explode('_', $snake)));
    }
}
