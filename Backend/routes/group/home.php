<?php

use Illuminate\Support\Facades\Route;

/**
 * Home Page Group
 */
Route::group(
    [
        'prefix'        => '/home',
        'middleware'    => 'auth',
        'namespace'     => 'Home',
    ], function () {

    /**
     * Home Page Page
     */
    Route::get('/edit', 'HomeController@edit')->name('home.edit');
    Route::post('/{page}/update', 'HomeController@update')->name('home.update');

    /**
     * Home Page Seo Page
     */
    Route::group([
        'prefix'        => '/seo',
        'middleware'    => 'permission:seo_access'
    ], function () {

        Route::get('/{id}', 'HomeController@seo')->name('home.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('home.seo.update');

    });

});

