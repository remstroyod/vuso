<?php

use Illuminate\Support\Facades\Route;

/**
 * Profile Group
 */
Route::group(
    [
        'prefix'        => '/lk',
        'middleware'    => 'auth',
        'namespace'     => 'Profile',
    ], function () {

    /**
     * Profile Page
     */
    Route::get('/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/{page}/update', 'ProfileController@update')->name('profile.update');

    /**
     * Contacts Seo Page
     */
    Route::group([
        'prefix'        => '/seo',
    ], function () {

        Route::get('/{id}', 'ProfileController@seo')->name('profile.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('profile.seo.update');

    });

});

