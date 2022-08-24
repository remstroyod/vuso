<?php

use Illuminate\Support\Facades\Route;

/**
 * Sales Group
 */
Route::group(
    [
        'prefix'        => '/sales',
        'middleware'    => 'auth',
        'namespace'     => 'Sales',
    ], function () {

    /**
     * Sales Page
     */
    Route::get('/edit', 'SalesController@edit')->name('sales.edit');
    Route::post('/{page}/update', 'SalesController@update')->name('sales.update');

    /**
     * Sales List
     */
    Route::group(
        [
            'prefix'        => '/list',
        ], function () {

        Route::get('/', 'ListController@index')->name('sales.list.index');
        Route::post('/', 'ListController@store')->name('sales.list.store');
        Route::get('/create', 'ListController@create')->name('sales.list.create');
        Route::get('/{sales}/edit', 'ListController@edit')->name('sales.list.edit');
        Route::post('/{sales}/update', 'ListController@update')->name('sales.list.update');
        Route::delete('/{sales}/destroy', 'ListController@destroy')->name('sales.list.destroy');

        /**
         * Articles List Seo Page
         */
        Route::group([
            'prefix'        => '/seo',
        ], function () {

            Route::get('/{sales}', 'ListController@seo')->name('sales.list.seo');
            Route::post('/{sales}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('sales.seo.list.update');

        });

    });

    /**
     * Sales Categories
     */
    Route::group(
        [
            'prefix'        => '/categories',
        ], function () {

        Route::get('/', 'CategoriesController@index')->name('sales.categories.index');
        Route::post('/', 'CategoriesController@store')->name('sales.categories.store');
        Route::get('/create', 'CategoriesController@create')->name('sales.categories.create');
        Route::get('/{categories}/edit', 'CategoriesController@edit')->name('sales.categories.edit');
        Route::post('/{categories}/update', 'CategoriesController@update')->name('sales.categories.update');
        Route::delete('/{categories}/destroy', 'CategoriesController@destroy')->name('sales.categories.destroy');

        /**
         * Articles Categories Seo Page
         */
        Route::group([
            'prefix'        => '/seo',
        ], function () {

            Route::get('/{categories}', 'CategoriesController@seo')->name('sales.categories.seo');
            Route::post('/{categories}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('sales.seo.categories.update');

        });

    });

    /**
     * Sales Seo Page
     */
    Route::group(
        [
            'prefix'        => '/seo',
        ], function () {

        Route::get('/{id}', 'SalesController@seo')->name('sales.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('sales.seo.update');

    });

});

