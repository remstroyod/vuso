<?php

use Illuminate\Support\Facades\Route;

/**
 * Static Page Group
 */
Route::group(
    [
        'prefix'        => '/static-pages',
        'middleware'    => 'auth',
        'namespace'     => 'Pages',
    ], function () {

    /**
     * Static Page
     */
    Route::get('/', 'PagesController@index')->name('static-pages.index');
    Route::get('/create', 'PagesController@create')->name('static-pages.create');
    Route::get('/{pages}/edit', 'PagesController@edit')->name('static-pages.edit');
    Route::post('/{pages}/update', 'PagesController@update')->name('static-pages.update');
    Route::delete('/{pages}/destroy', 'PagesController@destroy')->name('static-pages.destroy');
    Route::post('/', 'PagesController@store')->name('static-pages.store');

    /**
     * Static Seo Page
     */
    Route::group([
        'prefix'        => '/{pages}/seo',
    ], function () {

        Route::get('/{id}', 'PagesController@seo')->name('static-pages.seo');
        Route::post('/{page}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('static-pages.seo.update');

    });

});

