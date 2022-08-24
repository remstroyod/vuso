<?php

namespace Frontend\Providers;

use Backend\Enums\FormsEnum;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Date\Date;
use Common\Mixins\StrMixin;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Passport::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Date::setLocale(config('app.locale'));

        $this->app->bind('menu', 'Frontend\Services\Menu');

        View::composer('*', function ($view){

            /**
             * Forms
             */
            $view->with('forms', (object) FormsEnum::toArray());

        });

        Str::mixin(new StrMixin);

    }
}
