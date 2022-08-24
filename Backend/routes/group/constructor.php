<?php

use Illuminate\Support\Facades\Route;

/**
 * Constructor Pages Group
 */
Route::group(
    [
        'prefix'        => '/constructor',
        'middleware'    => 'auth',
        'namespace'     => 'Constructor',
    ], function () {

    /**
     * Constructor Page
     */
    Route::get('/', 'ConstructorController@index')->name('constructor.index');
    Route::get('/{pages}/edit', 'ConstructorController@edit')->name('constructor.edit');
    Route::get('/create', 'ConstructorController@create')->name('constructor.create');
    Route::delete('/{pages}/destroy', 'ConstructorController@destroy')->name('constructor.destroy');
    Route::post('/{pages}/update', 'ConstructorController@update')->name('constructor.update');
    Route::post('/', 'ConstructorController@store')->name('constructor.store');

    Route::get('/{pages}/builder', 'ConstructorController@show')->name('constructor.show');
    Route::post('/{pages}/builder', 'ConstructorController@builder')->name('constructor.builder');

    /**
     * Dinamyc Records
     */
    Route::group(
        [
            'prefix'        => '/{pages}/dinamyc',
        ], function () {

        Route::get('/', 'ConstructorDinamycController@index')->name('constructor.dinamyc.index');
        Route::get('/{shortcode}', 'ConstructorDinamycShortcodeController@index')->name('constructor.dinamyc.shortcode.index');
        Route::get('/{shortcode}/create', 'ConstructorDinamycShortcodeController@create')->name('constructor.dinamyc.shortcode.create');
        Route::delete('/{item}/{shortcode}/destroy', 'ConstructorDinamycShortcodeController@destroy')->name('constructor.dinamyc.shortcode.destroy');
        Route::get('/{item}/{shortcode}/edit', 'ConstructorDinamycShortcodeController@edit')->name('constructor.dinamyc.shortcode.edit');
        Route::post('/{shortcode}/', 'ConstructorDinamycShortcodeController@store')->name('constructor.dinamyc.shortcode.store');
        Route::post('/{item}/{shortcode}/update', 'ConstructorDinamycShortcodeController@update')->name('constructor.dinamyc.shortcode.update');
        Route::post('/{shortcode}/update', 'ConstructorShortcodeController@update')->name('constructor.shortcode.update');

    });

    /**
     * Reviews Seo Page
     */
    Route::group(
        [
            'prefix'        => '/{pages}/seo',
        ], function () {

        Route::get('/{id}', 'ConstructorController@seo')->name('constructor.seo');
        Route::post('/{page}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('constructor.seo.update');

    });

});

