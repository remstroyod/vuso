<?php

namespace Frontend\Providers;

use Frontend\Models\Settings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if ( \Schema::hasTable('settings') )
        {
            Cache::forever('settings', Settings::all());
        }

    }
}
