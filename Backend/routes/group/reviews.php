<?php

use Illuminate\Support\Facades\Route;

/**
 * Reviews Group
 */
Route::group(
    [
        'prefix'        => '/reviews',
        'middleware'    => 'auth',
        'namespace'     => 'Reviews',
    ], function () {

    /**
     * Reviews Page
     */
    Route::get('/edit', 'ReviewsController@edit')->name('reviews.edit');
    Route::post('/{page}/update', 'ReviewsController@update')->name('reviews.update');

    /**
     * Reviews List
     */
    Route::group(
        [
            'prefix'        => '/list',
        ], function () {

        Route::get('/', 'ListController@index')->name('reviews.list.index');
        Route::post('/', 'ListController@store')->name('reviews.list.store');
        Route::get('/create', 'ListController@create')->name('reviews.list.create');
        Route::get('/{reviews}/edit', 'ListController@edit')->name('reviews.list.edit');
        Route::post('/{reviews}/update', 'ListController@update')->name('reviews.list.update');
        Route::delete('/{reviews}/destroy', 'ListController@destroy')->name('reviews.list.destroy');

        /**
         * Articles List Seo Page
         */
        Route::group([
            'prefix'        => '/seo',
        ], function () {

            Route::get('/{reviews}', 'ListController@seo')->name('reviews.list.seo');
            Route::post('/{reviews}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('reviews.seo.list.update');

        });

    });

    /**
     * Reviews Seo Page
     */
    Route::group(
        [
            'prefix'        => '/seo',
        ], function () {

        Route::get('/{id}', 'ReviewsController@seo')->name('reviews.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('reviews.seo.update');

    });

});

