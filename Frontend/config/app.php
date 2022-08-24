<?php

$return_array = [

    'name' => 'FrontEnd',

    'providers' => [

        /*
        * Package Service Providers...
        */

        /*
        * Application Service Providers...
        */
        Frontend\Providers\AppServiceProvider::class,
        Frontend\Providers\AuthServiceProvider::class,
        Frontend\Providers\EventServiceProvider::class,
        Frontend\Providers\RouteServiceProvider::class,
        Frontend\Providers\SettingsServiceProvider::class,
        Frontend\Providers\BroadcastServiceProvider::class,

        /**
         * Localization
         */
        Frontend\Providers\Localization\LocalizationServiceProvider::class,

        /**
         * Catalog
         */
        Frontend\Providers\CatalogServiceProvider::class,

        /**
         * Socialite
         */
        //Laravel\Socialite\SocialiteServiceProvider::class,
        \SocialiteProviders\Manager\ServiceProvider::class,

        /**
         * Cart
         */
        Darryldecode\Cart\CartServiceProvider::class,
        Frontend\Providers\ComposerServiceProvider::class,

        /**
         * Google Drive
         */
        Frontend\Providers\GoogleDriveServiceProvider::class,

        /**
         * reCaptcha
         */
        AlbertCht\InvisibleReCaptcha\InvisibleReCaptchaServiceProvider::class,

        /**
         * Shortcodes
         */
        Frontend\Providers\ShortcodesServiceProvider::class,
        Webwizo\Shortcodes\ShortcodesServiceProvider::class,

    ],

    'aliases' => [
        'LocalizationService' => Frontend\Providers\Localization\LocalizationService::class,
        'Socialite' => Laravel\Socialite\Facades\Socialite::class,
        'Cart' => Darryldecode\Cart\Facades\CartFacade::class,
        'Menu' => Frontend\Facades\Menu::class,
        'Shortcode' => Webwizo\Shortcodes\Facades\Shortcode::class,
    ],

];

$file_name = basename(__FILE__);

$common_config = realpath(app()->basePath().'/../Common/config/'.$file_name);
if(is_file($common_config)){
    return array_merge_recursive($return_array, include ($common_config));
}

return $return_array;
