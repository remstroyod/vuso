<?php

use Illuminate\Support\Facades\Route;

/**
 * Informations Group
 */
Route::group(
    [
        'prefix'        => '/informations',
        'middleware'    => 'auth',
        'namespace'     => 'Informations',
    ], function () {

    /**
     * Informations Page
     */
    Route::get('/edit', 'InformationsController@edit')->name('informations.edit');
    Route::post('/{page}/update', 'InformationsController@update')->name('informations.update');

    /**
     * Informations Categories Page
     */
    Route::group(
        [
            'prefix'        => '/categories',
        ], function () {

        Route::get('/', 'CategoriesController@index')->name('informations.categories.index');
        Route::post('/', 'CategoriesController@store')->name('informations.categories.store');
        Route::get('/create', 'CategoriesController@create')->name('informations.categories.create');
        Route::delete('/{categories}/destroy', 'CategoriesController@destroy')->name('informations.categories.destroy');
        Route::get('/{categories}/edit', 'CategoriesController@edit')->name('informations.categories.edit');
        Route::post('/{categories}/update', 'CategoriesController@update')->name('informations.categories.update');

        /**
         * Partners Categories Seo Page
         */
        Route::group([
            'prefix'        => '/seo',
        ], function () {

            Route::get('/{categories}', 'CategoriesController@seo')->name('informations.categories.seo');
            Route::post('/{categories}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('informations.seo.categories.update');

        });

    });

    /**
     * Informations List Page
     */
    Route::group(
        [
            'prefix'        => '/list',
        ], function () {

        Route::get('/', 'ListController@index')->name('informations.list.index');
        Route::post('/', 'ListController@store')->name('informations.list.store');
        Route::get('/create', 'ListController@create')->name('informations.list.create');
        Route::delete('/{informations}/destroy', 'ListController@destroy')->name('informations.list.destroy');
        Route::get('/{informations}/edit', 'ListController@edit')->name('informations.list.edit');
        Route::post('/{informations}/update', 'ListController@update')->name('informations.list.update');

        /**
         * Partners List Seo Page
         */
        Route::group([
            'prefix'        => '/seo',
        ], function () {

            Route::get('/{informations}', 'ListController@seo')->name('informations.list.seo');
            Route::post('/{informations}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('informations.seo.list.update');

        });

    });

    /**
     * Informations Seo Page
     */
    Route::group(
        [
            'prefix'        => '/seo',
        ], function () {

        Route::get('/{id}', 'InformationsController@seo')->name('informations.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('informations.seo.update');

    });

});

