<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        if (auth()->check() && auth()->user()->isAdmin()){
            if (!is_null($permission) && Gate::denies('has-permission', $permission)) {
                abort(404);
            }

            return $next($request);
        }

        abort(404);
    }
}
