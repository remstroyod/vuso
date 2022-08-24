<?php

$return_array = [

    'name' => 'BackEnd',

    'providers' => [
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        Backend\Providers\AppServiceProvider::class,
        Backend\Providers\AuthServiceProvider::class,
        Backend\Providers\EventServiceProvider::class,
        Backend\Providers\RouteServiceProvider::class,
        Backend\Providers\RolesServiceProvider::class,
        Backend\Providers\PermissionServiceProvider::class,
        Backend\Providers\SettingsServiceProvider::class,

        /**
         * Image
         */
        Intervention\Image\ImageServiceProvider::class,

        /**
         * Log
         */
        Venturecraft\Revisionable\RevisionableServiceProvider::class,

        /**
         * PDF
         */
        Barryvdh\DomPDF\ServiceProvider::class,

        /**
         * Google Drive
         */
        Backend\Providers\GoogleDriveServiceProvider::class,

    ],

    'aliases' => [
        'Image'     => Intervention\Image\Facades\Image::class,
        'PDF'       => Barryvdh\DomPDF\Facade::class,
        'Menu'      => Backend\Facades\Menu::class,
    ],

];

$file_name = basename(__FILE__);

$common_config = realpath(app()->basePath().'/../Common/config/'.$file_name);
if(is_file($common_config)){
    return array_merge_recursive($return_array, include ($common_config));
}

return $return_array;
