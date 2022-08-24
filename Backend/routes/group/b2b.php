<?php

use Illuminate\Support\Facades\Route;

/**
 * Catalog Group
 */
Route::group(
    [
        'prefix'        => '/b2b',
        'middleware'    => 'auth',
        'namespace'     => 'Catalog\\B2B',
    ], function () {

    /**
     * Catalog Page
     */
    Route::get('/edit', 'CatalogController@edit')->name('b2b.edit');
    Route::post('/{page}/update', 'CatalogController@update')->name('b2b.update');

    /**
     * Catalog Contragents
     */
    Route::group(
        [
            'prefix'        => '/contragents',
        ], function () {

        Route::get('/', 'ContragentsController@index')->name('b2b.contragents.index');
        Route::post('/', 'ContragentsController@store')->name('b2b.contragents.store');
        Route::get('/create', 'ContragentsController@create')->name('b2b.contragents.create');
        Route::get('/{contragents}/edit', 'ContragentsController@edit')->name('b2b.contragents.edit');
        Route::post('/{contragents}/update', 'ContragentsController@update')->name('b2b.contragents.update');
        Route::delete('/{contragents}/destroy', 'ContragentsController@destroy')->name('b2b.contragents.destroy');

    });

    /**
     * Catalog Categories
     */
    Route::group(
        [
            'prefix'        => '/categories',
        ], function () {

        Route::get('/', 'CategoryController@index')->name('b2b.categories.index');
        Route::post('/', 'CategoryController@store')->name('b2b.categories.store');
        Route::get('/create', 'CategoryController@create')->name('b2b.categories.create');
        Route::get('/{category}/edit', 'CategoryController@edit')->name('b2b.categories.edit');
        Route::post('/{category}/update', 'CategoryController@update')->name('b2b.categories.update');
        Route::delete('/{category}/destroy', 'CategoryController@destroy')->name('b2b.categories.destroy');

        /**
         * Catalog Categories Seo Page
         */
        Route::group([
            'prefix'        => '/seo',
        ], function () {

            Route::get('/{category}', 'CategoryController@seo')->name('b2b.categories.seo');
            Route::post('/{category}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('b2b.seo.categories.update');

        });

    });

    /**
     * Catalog Products
     */
    Route::group(
        [
            'prefix'        => '/products',
        ], function () {

        Route::get('/', 'ProductController@index')->name('b2b.products.index');
        Route::post('/', 'ProductController@store')->name('b2b.products.store');
        Route::get('/create', 'ProductController@create')->name('b2b.products.create');
        Route::get('/{product}/edit', 'ProductController@edit')->name('b2b.products.edit');
        Route::post('/{product}/update', 'ProductController@update')->name('b2b.products.update');
        Route::delete('/{product}/destroy', 'ProductController@destroy')->name('b2b.products.destroy');

        /**
         * Catalog Tags
         */
        Route::group(
            [
                'prefix'        => '/{product}/tags',
            ], function () {

            Route::get('/', 'ProductTagsController@index')->name('b2b.products.tags');
            Route::post('/', 'ProductTagsController@store')->name('b2b.products.tags.store');

        });

        /**
         * Catalog Constructor
         */
        Route::group(
            [
                'prefix'        => '/{product}/builder',
            ], function () {

            Route::get('/', 'ProductBuilderController@index')->name('b2b.products.builder');
            Route::post('/', 'ProductBuilderController@store')->name('b2b.products.builder.update');

        });

        /**
         * Dinamyc Records
         */
        Route::group(
            [
                'prefix'        => '/{product}/dinamyc',
                'namespace'     => 'Shortcode',
            ], function () {

            Route::get('/', 'ConstructorDinamycController@index')->name('b2b.constructor.dinamyc.index');
            Route::get('/{shortcode}', 'ConstructorDinamycShortcodeController@index')->name('b2b.constructor.dinamyc.shortcode.index');
            Route::get('/{shortcode}/create', 'ConstructorDinamycShortcodeController@create')->name('b2b.constructor.dinamyc.shortcode.create');
            Route::delete('/{item}/{shortcode}/destroy', 'ConstructorDinamycShortcodeController@destroy')->name('b2b.constructor.dinamyc.shortcode.destroy');
            Route::get('/{item}/{shortcode}/edit', 'ConstructorDinamycShortcodeController@edit')->name('b2b.constructor.dinamyc.shortcode.edit');
            Route::post('/{shortcode}/', 'ConstructorDinamycShortcodeController@store')->name('b2b.constructor.dinamyc.shortcode.store');
            Route::post('/{item}/{shortcode}/update', 'ConstructorDinamycShortcodeController@update')->name('b2b.constructor.dinamyc.shortcode.update');
            Route::post('/{shortcode}/update', 'ConstructorShortcodeController@update')->name('b2b.constructor.shortcode.update');

        });

        /**
         * Catalog Products Seo Page
         */
        Route::group(
            [
                'prefix'        => '/seo',
            ], function () {

            Route::get('/{product}', 'ProductController@seo')->name('b2b.products.seo');
            Route::post('/{product}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('b2b.seo.products.update');

        });

    });

    /**
     * Catalog Seo Page
     */
    Route::group(
        [
            'prefix'        => '/seo',
        ], function () {

        Route::get('/{id}', 'CatalogController@seo')->name('b2b.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('b2b.seo.update');

    });



});

