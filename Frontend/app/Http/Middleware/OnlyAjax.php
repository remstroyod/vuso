<?php

namespace Frontend\Http\Middleware;

class OnlyAjax
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if ( ! $request->ajax())
            //return response('Forbidden.', 403);
            abort(404);

        return $next($request);
    }

}
