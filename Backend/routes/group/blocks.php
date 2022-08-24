<?php

use Illuminate\Support\Facades\Route;

/**
 * Blocks Pages Group
 */
Route::group(
    [
        'prefix'        => '/{page}/blocks',
        'middleware'    => 'auth',
        'namespace'     => 'Blocks',
    ], function () {

    /**
     * Blocks Page
     */
    Route::get('/', 'BlocksDefaultController@index')->name('blocks.default.index');
    Route::post('/', 'BlocksDefaultController@store')->name('blocks.default.store');
    Route::get('/create', 'BlocksDefaultController@create')->name('blocks.default.create');
    Route::get('/{block}/edit', 'BlocksDefaultController@edit')->name('blocks.default.edit');
    Route::post('/{block}/update', 'BlocksDefaultController@update')->name('blocks.default.update');
    Route::delete('/{block}/destroy', 'BlocksDefaultController@destroy')->name('blocks.default.destroy');

    /**
     * Blocks Elements Page
     */
    Route::group(
        [
            'prefix'        => '/{block}/elements',
        ], function () {

            Route::get('/', 'ElementsDefaultController@index')->name('blocks.default.elements.index');
            Route::post('/', 'ElementsDefaultController@store')->name('blocks.default.elements.store');
            Route::get('/create', 'ElementsDefaultController@create')->name('blocks.default.elements.create');
            Route::get('/{element}/edit', 'ElementsDefaultController@edit')->name('blocks.default.elements.edit');
            Route::post('/{element}/update', 'ElementsDefaultController@update')->name('blocks.default.elements.update');
            Route::delete('/{element}/destroy', 'ElementsDefaultController@destroy')->name('blocks.default.elements.destroy');

        }
    );


});

Route::group(
    [
        'prefix'        => '/static-pages/{page}/blocks',
        'middleware'    => 'auth',
        'namespace'     => 'Blocks',
    ], function () {

    /**
     * Blocks Page
     */
    Route::get('/', 'BlocksStaticPagesController@index')->name('blocks.static.index');
    Route::post('/', 'BlocksStaticPagesController@store')->name('blocks.static.store');
    Route::get('/create', 'BlocksStaticPagesController@create')->name('blocks.static.create');
    Route::get('/{block}/edit', 'BlocksStaticPagesController@edit')->name('blocks.static.edit');
    Route::post('/{block}/update', 'BlocksStaticPagesController@update')->name('blocks.static.update');
    Route::delete('/{block}/destroy', 'BlocksStaticPagesController@destroy')->name('blocks.static.destroy');

    /**
     * Blocks Elements Page
     */
    Route::group(
        [
            'prefix'        => '/{block}/elements',
        ], function () {

        Route::get('/', 'ElementsStaticPagesController@index')->name('blocks.static.elements.index');
        Route::post('/', 'ElementsStaticPagesController@store')->name('blocks.static.elements.store');
        Route::get('/create', 'ElementsStaticPagesController@create')->name('blocks.static.elements.create');
        Route::get('/{element}/edit', 'ElementsStaticPagesController@edit')->name('blocks.static.elements.edit');
        Route::post('/{element}/update', 'ElementsStaticPagesController@update')->name('blocks.static.elements.update');
        Route::delete('/{element}/destroy', 'ElementsStaticPagesController@destroy')->name('blocks.static.elements.destroy');

    }
    );


});

Route::group(
    [
        'prefix'        => '/{page}/categories/blocks/{category}',
        'middleware'    => 'auth',
        'namespace'     => 'Blocks',
    ], function () {

    /**
     * Blocks Page
     */
    Route::get('/', 'BlocksProductCategoryController@index')->name('blocks.catalog.category.index');
    Route::post('/', 'BlocksProductCategoryController@store')->name('blocks.catalog.category.store');
    Route::get('/create', 'BlocksProductCategoryController@create')->name('blocks.catalog.category.create');
    Route::get('/{block}/edit', 'BlocksProductCategoryController@edit')->name('blocks.catalog.category.edit');
    Route::post('/{block}/update', 'BlocksProductCategoryController@update')->name('blocks.catalog.category.update');
    Route::delete('/{block}/destroy', 'BlocksProductCategoryController@destroy')->name('blocks.catalog.category.destroy');

    /**
     * Blocks Elements Page
     */
    Route::group(
        [
            'prefix'        => '/{block}/elements',
        ], function () {

        Route::get('/', 'ElementsProductCategoryController@index')->name('blocks.catalog.category.elements.index');
        Route::post('/', 'ElementsProductCategoryController@store')->name('blocks.catalog.category.elements.store');
        Route::get('/create', 'ElementsProductCategoryController@create')->name('blocks.catalog.category.elements.create');
        Route::get('/{element}/edit', 'ElementsProductCategoryController@edit')->name('blocks.catalog.category.elements.edit');
        Route::post('/{element}/update', 'ElementsProductCategoryController@update')->name('blocks.catalog.category.elements.update');
        Route::delete('/{element}/destroy', 'ElementsProductCategoryController@destroy')->name('blocks.catalog.category.elements.destroy');

    }
    );


});
