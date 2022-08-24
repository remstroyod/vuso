<?php

use Illuminate\Support\Str;
use Illuminate\Support\Arr;


/**
 * @param $locale
 * @return string
 */
function fullUrl($locale)
{

    $default_locale = config('app.fallback_locale');

    if( $locale === $default_locale )
    {

        $path = Str::remove($locale, request()->path());
        $locale = '/';

    }else{
        $locale = '/' . $locale . '/';
        $path = request()->path();
    }

    $host = request()->getSchemeAndHttpHost();

    $url = $locale . $path;
    $url = Str::replace('//', '/', $url);

    return $host . $url;

}


function changeLocal($locale){

    $available_locales = config('app.available_locales');

    $host = request()->getSchemeAndHttpHost();

    $segments = request()->segments();
    
    if (request()->method() === 'GET') 
    {
        
        if(!empty($segments[0])){

            if(Arr::has($available_locales, $segments[0])){
            
                $segments[0] = $locale;
            
                $segmentsToString =  implode("/", $segments);
            
            }else{
            
                $prependLocale = Arr::prepend($segments, $locale);
            
                $segmentsToString =  implode("/", $prependLocale);
            }
            
            return $host . '/' . $segmentsToString;
        
        }else{

            return $host . '/' . $locale;
        
        }
    }else{

        return back();
    
    }
}

/**
 * Price Format
 */
if (!function_exists('priceFormat')) {
    function priceFormat($price = 0, $decimal = 0, $symbol = ' грн.')
    {
        return number_format($price, $decimal, '.', ' ') . $symbol;
    }
}
