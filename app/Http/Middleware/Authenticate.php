<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
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

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }


        $site = site()->getCurrent();
        $user = Auth::guard($guard)->user();
        $userSiteId = $user->site_id;

        if ($site == null && $userSiteId != null || $site != null && $site->id != $userSiteId) {

            Auth::guard($guard)->logout();
            $url = $user->site->getRootUrl().'/'.$request->path();
            return redirect()->away($url);
        }

        return $next($request);
    }
}
