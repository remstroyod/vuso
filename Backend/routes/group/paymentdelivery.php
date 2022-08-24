<?php

use Illuminate\Support\Facades\Route;

/**
 * PaymentDelivery Group
 */
Route::group(
    [
        'prefix'        => '/payment_delivery',
        'middleware'    => 'auth',
        'namespace'     => 'PaymentDelivery',
    ], function () {

    /**
     * PaymentDelivery Page
     */
    Route::get('/edit', 'PaymentDeliveryController@edit')->name('payment_delivery.edit');
    Route::post('/{page}/update', 'PaymentDeliveryController@update')->name('payment_delivery.update');

    /**
     * PaymentDelivery Categories Page
     */
    Route::group(
        [
            'prefix'        => '/categories',
        ], function () {

        Route::get('/', 'CategoriesController@index')->name('payment_delivery.categories.index');
        Route::post('/', 'CategoriesController@store')->name('payment_delivery.categories.store');
        Route::get('/create', 'CategoriesController@create')->name('payment_delivery.categories.create');
        Route::delete('/{categories}/destroy', 'CategoriesController@destroy')->name('payment_delivery.categories.destroy');
        Route::get('/{categories}/edit', 'CategoriesController@edit')->name('payment_delivery.categories.edit');
        Route::post('/{categories}/update', 'CategoriesController@update')->name('payment_delivery.categories.update');

        /**
         * Partners Categories Seo Page
         */
        Route::group([
            'prefix'        => '/seo',
        ], function () {

            Route::get('/{categories}', 'CategoriesController@seo')->name('payment_delivery.categories.seo');
            Route::post('/{categories}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('payment_delivery.seo.categories.update');

        });

    });

    /**
     * PaymentDelivery Seo Page
     */
    Route::group(
        [
            'prefix'        => '/seo',
        ], function () {

        Route::get('/{id}', 'PaymentDeliveryController@seo')->name('payment_delivery.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('payment_delivery.seo.update');

    });

});

