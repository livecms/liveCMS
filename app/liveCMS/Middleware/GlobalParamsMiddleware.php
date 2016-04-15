<?php

namespace App\liveCMS\Middleware;

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
        view()->share('global_params', globalParams());
        
        return $next($request);
    }
}
