<?php

use Illuminate\Support\Facades\Route;

/**
 * Settings Group
 */
Route::group(
    [
        'prefix'        => '/settings',
        'middleware'    => 'auth',
        'namespace'     => 'Settings',
    ],
    function ()  {

        Route::get('/', 'SettingsController@edit')->name('settings.edit');
        Route::post('/update', 'SettingsController@update')->name('settings.update');

    });

