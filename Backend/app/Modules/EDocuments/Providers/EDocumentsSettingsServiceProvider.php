<?php

namespace Backend\Modules\EDocuments\Providers;

use Backend\Modules\EDocuments\Models\EDocumentsSettings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class EDocumentsSettingsServiceProvider extends ServiceProvider
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

        Cache::forever('edocuments_settings', EDocumentsSettings::all());

    }
}
