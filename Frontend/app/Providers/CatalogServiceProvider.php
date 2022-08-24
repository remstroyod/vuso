<?php

namespace Frontend\Providers;

use Frontend\Models\Catalog\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
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

        View::composer(['partials.header'], function ($view){

            /**
             * Categories
             */
            $catalog_menu = Category::whereDefault()->get();
            $view->with('catalog_categories', $catalog_menu);

        });

    }
}
