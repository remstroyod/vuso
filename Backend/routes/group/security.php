<?php

use Illuminate\Support\Facades\Route;

/**
 * Security Group
 */
Route::group(
    [
        'prefix' => '/security',
        'middleware'    => 'auth',
        'namespace' => 'Security',
        //'middleware'    => 'role:admin'
    ],
    function ()  {

        /**
         * Security Roles Page
         */
        Route::group([
            'prefix'        => '/roles',
        ], function () {
            Route::get('/', 'RolesController@index')->name('security.roles.index');
            Route::post('/', 'RolesController@store')->name('security.roles.store');
            Route::get('/create', 'RolesController@create')->name('security.roles.create');
            Route::delete('/{role}/destroy', 'RolesController@destroy')->name('security.roles.destroy');
            Route::get('/{role}/edit', 'RolesController@edit')->name('security.roles.edit');
            Route::post('/{role}/update', 'RolesController@update')->name('security.roles.update');
        });

        /**
         * Security Permission Page
         */
        Route::group([
            'prefix'        => '/permission',
        ], function () {
            Route::get('/', 'PermissionController@index')->name('security.permission.index');
            Route::post('/', 'PermissionController@store')->name('security.permission.store');
            Route::get('/create', 'PermissionController@create')->name('security.permission.create');
            Route::delete('/{permission}/destroy', 'PermissionController@destroy')->name(
                'security.permission.destroy'
            );
            Route::get('/{permission}/edit', 'PermissionController@edit')->name('security.permission.edit');
            Route::post('/{permission}/update', 'PermissionController@update')->name(
                'security.permission.update'
            );
        });

    });

