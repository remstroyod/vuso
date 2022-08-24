<?php

namespace Frontend\Providers;

use Frontend\Http\ViewComposers\CartComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer(['partials.header'], CartComposer::class);

    }
}
