<?php

namespace Backend\Http\Middleware;

use Backend\Http\Controllers\MenusController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Menus
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Session::has('locale')) :
            App::setLocale(Session::get('locale'));
        endif;

        return $next($request);

    }
}
