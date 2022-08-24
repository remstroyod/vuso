<?php

namespace Frontend\Providers\Localization;

use Illuminate\Support\ServiceProvider;

class LocalizationServiceProvider extends ServiceProvider
{

    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind("Localization", "Frontend\Providers\Localization\Localization");
    }
}
