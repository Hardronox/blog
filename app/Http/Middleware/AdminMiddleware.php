<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (!$user = Auth::user())
        {
            abort(404);
        }
        else
        {
            if ($user->hasRole('admin'))
                return $next($request);
            else
                abort(404);
        }

        return $next($request);
    }
}
