<?php

namespace Backend\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class RolesServiceProvider extends ServiceProvider
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
        /**
         * is Role Current User
         */
        Blade::directive('role', function ($role){
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";
        });
        Blade::directive('endrole', function ($role){
            return "<?php endif; ?>";
        });

        /**
         * is not Role Current User
         */
        Blade::directive('roleunless', function ($role){
            return "<?php if(auth()->check() && !auth()->user()->hasRole({$role})): ?>";
        });
        Blade::directive('endroleunless', function ($role){
            return "<?php endif; ?>";
        });

        /**
         * is Permission Current User
         */
        Blade::directive('permission', function ($permission){

            return "<?php if( auth()->user()->hasRole('admin') || auth()->user()->can({$permission}) ): ?>";

        });
        Blade::directive('endpermission', function ($permission){

            return "<?php endif; ?>";

        });

    }
}
