<?php

namespace Backend\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermissionsMiddleware
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission = null)
    {
        if($permission !== null && !auth()->user()->can($permission) && !auth()->user()->hasRole('admin')) {
            abort(404);
        }
        return $next($request);
    }
}
