<?php

use Illuminate\Support\Facades\Route;

/**
 * Menu Group
 */
Route::group(
    [
        'prefix'        => '/menu',
        'middleware'    => 'auth',
        'namespace'     => 'Menu',
    ], function () {


    Route::get('/', 'MenuController@index')->name('menu.index');
    Route::post('/', 'MenuController@store')->name('menu.store');
    Route::get('/create', 'MenuController@create')->name('menu.create');
    Route::get('/{menu}/edit', 'MenuController@edit')->name('menu.edit');
    Route::post('/{menu}/update', 'MenuController@update')->name('menu.update');
    Route::delete('/{menu}/destroy', 'MenuController@destroy')->name('menu.destroy');

    /**
     * Menu Elements Page
     */
    Route::group(
        [
            'prefix'        => '/{menu}/elements',
        ], function () {

        Route::get('/', 'MenuElementsController@index')->name('menu.elements.index');
        Route::post('/', 'MenuElementsController@store')->name('menu.elements.store');
        Route::get('/create', 'MenuElementsController@create')->name('menu.elements.create');
        Route::get('/{element}/edit', 'MenuElementsController@edit')->name('menu.elements.edit');
        Route::post('/{element}/update', 'MenuElementsController@update')->name('menu.elements.update');
        Route::delete('/{element}/destroy', 'MenuElementsController@destroy')->name('menu.elements.destroy');

    }
    );

});

