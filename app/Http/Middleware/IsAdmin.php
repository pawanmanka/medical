<?php 

namespace App\Http\Middleware;

use Closure;

class IsAdmin{

    public function handle($request, Closure $next)
    {
        if (\Auth::id() != null && \Auth::user()->hasRole(config('application.admin_role'))) {
            return $next($request);
        }
        return redirect('/administrator/login');

    }
}