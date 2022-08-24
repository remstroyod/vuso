<?php

use Illuminate\Support\Facades\Route;

/**
 * PayHub Group
 */
Route::group(
    [

        'prefix'        => '/payhub',
        'middleware'    => 'auth',

    ], function () {

    /**
     * PayHub Group
     */
    Route::group(
        [
            'prefix'        => '/',
        ], function () {

        Route::get('/', 'PayHubController@index')->name('payhub.index');

        /**
         * Systems
         */
        Route::get('/systems', 'PayHubSystemsController@index')->name('payhub.systems.index');
        Route::post('/systems', 'PayHubSystemsController@store')->name('payhub.systems.store');
        Route::get('/systems/create', 'PayHubSystemsController@create')->name('payhub.systems.create');
        Route::get('/systems/{system}/edit', 'PayHubSystemsController@edit')->name('payhub.systems.edit');
        Route::post('/systems/{system}/update', 'PayHubSystemsController@update')->name('payhub.systems.update');
        Route::delete('/systems/{system}/destroy', 'PayHubSystemsController@destroy')->name('payhub.systems.destroy');

        /**
         * Logs
         */
        Route::get('/logs', 'PayHubLogsController@index')->name('payhub.logs.index');

    });

});
