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
        if (Auth::guard($guard)->check()) {
     
            $user = Auth::guard($guard)->user();
            $root = $user->getSiteRootUrl();
            $adminSlug  = globalParams('slug_admin', config('livecms.slugs.admin'));
            $url = $root.'/'.$adminSlug;
            return redirect()->away($url);
        }

        return $next($request);
    }
}
