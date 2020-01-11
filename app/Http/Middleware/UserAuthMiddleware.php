<?php

namespace App\Http\Middleware;
use Closure;


class UserAuthMiddleware{
    public function handle($request, Closure $next)
    {
        if (\Auth::id() != null && \Auth::user()->status == 0) {
            return $next($request);
        }
        \Auth::logout();
        return redirect('/login');
    }
}