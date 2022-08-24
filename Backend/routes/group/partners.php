<?php

use Illuminate\Support\Facades\Route;

/**
 * Partners Group
 */
Route::group(
    [
        'prefix'        => '/partners',
        'middleware'    => 'auth',
        'namespace'     => 'Partners',
    ], function () {

    /**
     * Partners Page
     */
    Route::get('/edit', 'PartnersController@edit')->name('partners.edit');
    Route::post('/{page}/update', 'PartnersController@update')->name('partners.update');

    /**
     * Partners Categories Page
     */
    Route::group(
        [
            'prefix'        => '/categories',
        ], function () {

        Route::get('/', 'CategoriesController@index')->name('partners.categories.index');
        Route::post('/', 'CategoriesController@store')->name('partners.categories.store');
        Route::get('/create', 'CategoriesController@create')->name('partners.categories.create');
        Route::delete('/{categories}/destroy', 'CategoriesController@destroy')->name('partners.categories.destroy');
        Route::get('/{categories}/edit', 'CategoriesController@edit')->name('partners.categories.edit');
        Route::post('/{categories}/update', 'CategoriesController@update')->name('partners.categories.update');

        /**
         * Partners Categories Seo Page
         */
        Route::group([
            'prefix'        => '/seo',
        ], function () {

            Route::get('/{categories}', 'CategoriesController@seo')->name('partners.categories.seo');
            Route::post('/{categories}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('partners.seo.categories.update');

        });

    });

    /**
     * Partners List Page
     */
    Route::group(
        [
            'prefix'        => '/list',
        ], function () {

        Route::get('/', 'ListController@index')->name('partners.list.index');
        Route::post('/', 'ListController@store')->name('partners.list.store');
        Route::get('/create', 'ListController@create')->name('partners.list.create');
        Route::delete('/{partners}/destroy', 'ListController@destroy')->name('partners.list.destroy');
        Route::get('/{partners}/edit', 'ListController@edit')->name('partners.list.edit');
        Route::post('/{partners}/update', 'ListController@update')->name('partners.list.update');

        /**
         * Partners List Seo Page
         */
        Route::group([
            'prefix'        => '/seo',
        ], function () {

            Route::get('/{partners}', 'ListController@seo')->name('partners.list.seo');
            Route::post('/{partners}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('partners.seo.list.update');

        });

    });

    /**
     * Partners Seo Page
     */
    Route::group(
        [
            'prefix'        => '/seo',
        ], function () {

        Route::get('/{id}', 'PartnersController@seo')->name('partners.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('partners.seo.update');

    });

});

