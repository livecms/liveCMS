<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $auth = Auth::guard($guard)->check();
        $site = site()->getCurrent();
        $userSiteId = $auth ? Auth::guard($guard)->user()->site_id : null;

        if ($auth && ($site == null && $userSiteId == null || $site != null && $site->id == $userSiteId)) {
            $adminSlug  = globalParams('slug_admin', config('livecms.slugs.admin'));
            return redirect($adminSlug);
        }

        return $next($request);
    }
}
