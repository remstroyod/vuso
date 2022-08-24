<?php

namespace Frontend\Providers;

use Frontend\Models\Constructor\ConstructorShortcode;
use Frontend\Shortcodes\ConstructorDinamycShortcode;
use Frontend\Shortcodes\FormShortcode;
use Illuminate\Support\ServiceProvider;
use Shortcode;

class ShortcodesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        Shortcode::register('form', FormShortcode::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $shortcodes = ConstructorShortcode::all();

        if( $shortcodes->count() )
        {

            foreach ( $shortcodes as $shortcode )
            {

                Shortcode::register($shortcode->shortcode, ConstructorDinamycShortcode::class);

            }

        }

    }

}
