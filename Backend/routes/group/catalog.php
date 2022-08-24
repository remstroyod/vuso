<?php

use Illuminate\Support\Facades\Route;

/**
 * Catalog Group
 */
Route::group(
    [
        'prefix'        => '/catalog',
        'middleware'    => 'auth',
        'namespace'     => 'Catalog',
    ], function () {

    /**
     * Catalog Page
     */
    Route::get('/edit', 'CatalogController@edit')->name('catalog.edit');
    Route::post('/{page}/update', 'CatalogController@update')->name('catalog.update');

    /**
     * Catalog Contragents
     */
    Route::group(
        [
            'prefix'        => '/contragents',
        ], function () {

        Route::get('/', 'ContragentsController@index')->name('catalog.contragents.index');
        Route::post('/', 'ContragentsController@store')->name('catalog.contragents.store');
        Route::get('/create', 'ContragentsController@create')->name('catalog.contragents.create');
        Route::get('/{contragents}/edit', 'ContragentsController@edit')->name('catalog.contragents.edit');
        Route::post('/{contragents}/update', 'ContragentsController@update')->name('catalog.contragents.update');
        Route::delete('/{contragents}/destroy', 'ContragentsController@destroy')->name('catalog.contragents.destroy');

    });

    /**
     * Catalog Categories
     */
    Route::group(
        [
            'prefix'        => '/categories',
        ], function () {

        Route::get('/', 'CategoryController@index')->name('catalog.categories.index');
        Route::post('/', 'CategoryController@store')->name('catalog.categories.store');
        Route::get('/create', 'CategoryController@create')->name('catalog.categories.create');
        Route::get('/{category}/edit', 'CategoryController@edit')->name('catalog.categories.edit');
        Route::post('/{category}/update', 'CategoryController@update')->name('catalog.categories.update');
        Route::delete('/{category}/destroy', 'CategoryController@destroy')->name('catalog.categories.destroy');

        /**
         * Catalog Categories Seo Page
         */
        Route::group([
            'prefix'        => '/seo',
        ], function () {

            Route::get('/{category}', 'CategoryController@seo')->name('catalog.categories.seo');
            Route::post('/{category}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('catalog.seo.categories.update');

        });

    });

    /**
     * Catalog Products
     */
    Route::group(
        [
            'prefix'        => '/products',
        ], function () {

        Route::get('', 'ProductController@index')->name('catalog.products.index');
        Route::post('', 'ProductController@store')->name('catalog.products.store');
        Route::get('create', 'ProductController@create')->name('catalog.products.create');
        Route::get('{product}/edit',[Backend\Http\Controllers\Catalog\ProductController::class, 'edit'])->name('catalog.products.edit');
        Route::post('{product}/update', 'ProductController@update')->name('catalog.products.update');
        Route::delete('{product}/destroy', 'ProductController@destroy')->name('catalog.products.destroy');

        /**
         * Widget Page
         */
        Route::group(
            [
                'prefix'        => '/{product}/widget',
            ], function () {

            Route::get('/', 'WidgetController@edit')->name('catalog.widget.edit');

        });

        /**
         * EDocuments Page
         */
        Route::group(
            [
                'prefix'        => '/{product}/edocuments',
            ], function () {

            Route::get('/', 'EDocumentsController@edit')->name('catalog.edocuments.edit');
            Route::post('/update', 'EDocumentsController@update')->name('catalog.edocuments.update');

        });

        /**
         * Catalog Products Seo Page
         */
        Route::group(
            [
                'prefix'        => '/seo',
            ], function () {

            Route::get('/{product}', 'ProductController@seo')->name('catalog.products.seo');
            Route::post('/{product}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('catalog.seo.products.update');

        });

    });

    /**
     * Catalog Seo Page
     */
    Route::group(
        [
            'prefix'        => '/seo',
        ], function () {

        Route::get('/{id}', 'CatalogController@seo')->name('catalog.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('catalog.seo.update');

    });



});

