<?php

use Illuminate\Support\Facades\Route;

/**
 * Promocodes Group
 */
Route::group(
    [
        'prefix'        => '/promocodes',
        'middleware'    => 'auth',
        'namespace'     => 'Ecommerce',
    ], function () {

    Route::get('/', 'PromocodesController@index')->name('ecommerce.promocodes.index');
    Route::post('/', 'PromocodesController@store')->name('ecommerce.promocodes.store');
    Route::delete('/{promocode}/destroy', 'PromocodesController@destroy')->name('ecommerce.promocodes.destroy');
    Route::get('/create', 'PromocodesController@create')->name('ecommerce.promocodes.create');
    Route::get('/{promocode}/edit', 'PromocodesController@edit')->name('ecommerce.promocodes.edit');
    Route::post('/{promocode}/update', 'PromocodesController@update')->name('ecommerce.promocodes.update');

});

