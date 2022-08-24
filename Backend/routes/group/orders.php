<?php

use Illuminate\Support\Facades\Route;

/**
 * Ecommerce Group
 */
Route::group(
    [
        'prefix'        => '/orders',
        'middleware'    => 'auth',
        'namespace'     => 'Ecommerce',
    ], function () {

    Route::get('/', 'OrdersController@index')->name('ecommerce.order.index');
    Route::get('/cancel/{user}/{document}', [Backend\Http\Controllers\Ecommerce\OrdersController::class, 'cancel'])->name('ecommerce.order.cancel');
    Route::delete('/{order}/destroy', 'OrdersController@destroy')->name('ecommerce.order.destroy');
    Route::get('/{order}/edit', 'OrdersController@edit')->name('ecommerce.order.edit');
    Route::post('/{order}/update', 'OrdersController@update')->name('ecommerce.order.update');
    Route::get('/{order}/history', 'OrdersController@history')->name('ecommerce.order.history.index');

});

