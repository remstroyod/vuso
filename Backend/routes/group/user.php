<?php

use Illuminate\Support\Facades\Route;

/**
 * Profile Group
 */
Route::group(
    [
        'prefix'        => '/profile',
        'middleware'    => 'auth',
        'namespace'     => 'Users\\Profile',
    ],
    function ()  {

        /**
         * Profile Page
         */
        Route::get('/', 'ProfileController@index')->name('users.profile.index');
        Route::get('/edit', 'ProfileController@edit')->name('users.profile.edit');
        Route::post('/edit', 'ProfileController@update')->name('users.profile.update');

        Route::get('/password', 'ProfileController@password')->name('users.profile.password');
        Route::post('/password', 'ProfileController@passwordUpdate')->name('users.profile.password.update');

        /**
         * Profile Socials Page
         */
        Route::group([
            'prefix'        => '/socials',
        ], function () {

            Route::get('/', 'SocialsController@index')->name('users.profile.socials.index');
            Route::post('/', 'SocialsController@store')->name('users.profile.socials.store');
            Route::get('/create', 'SocialsController@create')->name('users.profile.socials.create');
            Route::delete('/{socials}/destroy', 'SocialsController@destroy')->name('users.profile.socials.destroy');
            Route::get('/{socials}/edit', 'SocialsController@edit')->name('users.profile.socials.edit');
            Route::post('/{socials}/update', 'SocialsController@update')->name('users.profile.socials.update');

        });

    });

