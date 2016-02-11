<?php

use App\Models\Setting;

if (! function_exists('globalParams')) {

    function globalParams($key = null)
    {
        $global_params = Cache::rememberForever('global_params', function() {
            return Setting::lists('value', 'key');
        });
        
        if ($key == null) {
            return $global_params;
        }
        
        return isset($global_params[$key]) ? $global_params[$key] : false;
    }
}