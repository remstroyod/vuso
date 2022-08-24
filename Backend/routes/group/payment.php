<?php

use Illuminate\Support\Facades\Route;

/**
 * Contacts Group
 */
Route::group(
    [
        'prefix'        => '/payment',
        'middleware'    => 'auth',
        'namespace'     => 'Payment',
    ], function () {

    /**
     * Payment Page
     */
    Route::get('/edit', 'PaymentController@edit')->name('payment.edit');
    Route::post('/{page}/update', 'PaymentController@update')->name('payment.update');

    /**
     * Contacts Seo Page
     */
    Route::group([
        'prefix'        => '/seo',
    ], function () {

        Route::get('/{id}', 'PaymentController@seo')->name('payment.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('payment.seo.update');

    });

});

