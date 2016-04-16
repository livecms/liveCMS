<?php

namespace App\liveCMS\Middleware;

use Closure;
use Gate;

class ModelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $model, $privilege = 'read')
    {
        Gate::authorize($privilege, app($model));

        return $next($request);
    }
}
