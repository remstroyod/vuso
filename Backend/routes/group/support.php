<?php

use Illuminate\Support\Facades\Route;

/**
 * Support Group
 */
Route::group(
    [
        'prefix'        => '/support',
        'middleware'    => 'auth',
        'namespace'     => 'Support',
    ], function () {

    /**
     * Support Page
     */
    Route::get('/edit', 'SupportController@edit')->name('support.edit');
    Route::post('/{page}/update', 'SupportController@update')->name('support.update');

    /**
     * Contacts Seo Page
     */
    Route::group([
        'prefix'        => '/seo',
    ], function () {

        Route::get('/{id}', 'SupportController@seo')->name('support.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('support.seo.update');

    });

});

