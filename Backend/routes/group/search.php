<?php

use Illuminate\Support\Facades\Route;

/**
 * Search Group
 */
Route::group(
    [
        'prefix'        => '/search',
        'middleware'    => 'auth',
        'namespace'     => 'Search',
    ], function () {

    /**
     * Search Page
     */
    Route::get('/edit', 'SearchController@edit')->name('search.edit');
    Route::post('/{page}/update', 'SearchController@update')->name('search.update');

    /**
     * Search Seo Page
     */
    Route::group([
        'prefix'        => '/seo',
    ], function () {

        Route::get('/{id}', 'SearchController@seo')->name('search.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('search.seo.update');

    });

});

