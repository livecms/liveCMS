<?php

namespace App\Http\Middleware;

use Cache;
use Closure;
use App\Setting as Param;

class GlobalParamsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $global_params = Cache::rememberForever('global_params', function() {
            return Param::lists('value', 'key');
        });

        view()->share('global_params', $global_params);
        
        return $next($request);
    }
}
