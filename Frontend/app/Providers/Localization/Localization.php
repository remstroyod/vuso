<?php

namespace Frontend\Providers\Localization;

class Localization
{

    /**
     * @return string
     */
    public function locale()
    {
        $locale = request()->segment(1, '');

        if( $locale && array_key_exists( $locale, config('app.available_locales') ) ) :
            return $locale;
        endif;

        return "";

    }
}
