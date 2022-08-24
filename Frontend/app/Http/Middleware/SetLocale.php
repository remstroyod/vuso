<?php

namespace Frontend\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\App;

class SetLocale
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

        $available_locales = config('app.available_locales');

        $fallback_locale = config('app.fallback_locale');

        $segments = request()->segments();

        $lang = $fallback_locale;

        if(!empty($segments)){

            if(Arr::has($available_locales, $segments[0])){
                
                $lang = $segments[0];
            
            }
        
        }
        App::setLocale($lang);

        $dateLocale = ($lang === $fallback_locale) ? 'uk' : $lang;

        Date::setLocale($dateLocale);


        // $lang = ltrim($request->route()->getPrefix(), '/');
        // $lang = explode('/', $lang)[0];

        // if( $lang ) :

        //     App::setLocale($lang);

        // endif;

        return $next($request);
    }
}
