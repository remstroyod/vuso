<?php

use Illuminate\Support\Facades\Route;

/**
 * Articles Group
 */
Route::group(
    [
        'prefix'        => '/articles',
        'middleware'    => 'auth',
        'namespace'     => 'Articles',
    ], function () {

    /**
     * Articles Page
     */
    Route::get('/edit', 'ArticlesController@edit')->name('articles.edit');
    Route::post('/{page}/update', 'ArticlesController@update')->name('articles.update');

    /**
     * Articles List
     */
    Route::group(
        [
            'prefix'        => '/list',
        ], function () {

        Route::get('/', 'ListController@index')->name('articles.list.index');
        Route::post('/', 'ListController@store')->name('articles.list.store');
        Route::get('/create', 'ListController@create')->name('articles.list.create');
        Route::get('/{articles}/edit', 'ListController@edit')->name('articles.list.edit');
        Route::post('/{articles}/update', 'ListController@update')->name('articles.list.update');
        Route::delete('/{articles}/destroy', 'ListController@destroy')->name('articles.list.destroy');

        /**
         * Articles List Seo Page
         */
        Route::group([
            'prefix'        => '/seo',
        ], function () {

            Route::get('/{articles}', 'ListController@seo')->name('articles.list.seo');
            Route::post('/{articles}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('articles.seo.list.update');

        });

    });

    /**
     * Articles Categories
     */
    Route::group(
        [
            'prefix'        => '/categories',
        ], function () {

        Route::get('/', 'CategoriesController@index')->name('articles.categories.index');
        Route::post('/', 'CategoriesController@store')->name('articles.categories.store');
        Route::get('/create', 'CategoriesController@create')->name('articles.categories.create');
        Route::get('/{categories}/edit', 'CategoriesController@edit')->name('articles.categories.edit');
        Route::post('/{categories}/update', 'CategoriesController@update')->name('articles.categories.update');
        Route::delete('/{categories}/destroy', 'CategoriesController@destroy')->name('articles.categories.destroy');

        /**
         * Articles Categories Seo Page
         */
        Route::group([
            'prefix'        => '/seo',
        ], function () {

            Route::get('/{categories}', 'CategoriesController@seo')->name('articles.categories.seo');
            Route::post('/{categories}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('seo.categories.update');

        });

    });

    /**
     * Contacts Seo Page
     */
    Route::group([
        'prefix'        => '/seo',
    ], function () {

        Route::get('/{id}', 'ArticlesController@seo')->name('articles.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('articles.seo.update');

    });

});

