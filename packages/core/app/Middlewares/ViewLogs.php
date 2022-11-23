<?php

namespace Core\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewLogs
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('View All Logs')) {
            return $next($request);
        }

        abort(401, 'Unauthorised');
    }
}
