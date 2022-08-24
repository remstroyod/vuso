<?php

namespace Frontend\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AccessApi extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$guards)
    {

        $token = $request->header('token');

        if(empty($token))
        {
            $token = $request->input('token');
        }
        if(empty($token))
        {
            $token = $request->bearerToken();
        }

        if ($token !== env('API_TOKEN'))
        {

            return response()->json([
                'error' => 'Unauthenticated.'
            ], 401);

        }

        return $next($request);

    }
}
