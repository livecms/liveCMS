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

        $user = Auth::guard($guard)->user();
        $usid = $user->site ? $user->site->id : null;

        if (site()->id != $usid) {
            Auth::guard($guard)->logout();
            $url = $user->getSiteRootUrl().'/'.$request->path();
            return redirect()->away($url);
        }

        return $next($request);
    }
}
