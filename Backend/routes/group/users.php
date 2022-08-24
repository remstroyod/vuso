<?php

use Illuminate\Support\Facades\Route;

/**
 * Users Group
 */
Route::group(
    [
        'prefix'        => '/users',
        'middleware'    => 'auth',
        'namespace'     => 'Users',
    ], function () {

    /**
     * Users List Page
     */
    Route::get('', 'UsersController@index')->name('users.list.index');
    Route::get('{user}/edit', 'UsersController@edit')->name('users.list.edit');
    Route::post('{user}/edit', 'UsersController@update')->name('users.list.update');
    Route::delete('{user}/destroy', 'UsersController@destroy')->name('users.list.destroy');
    Route::get('create', 'UsersController@create')->name('users.list.create');
    Route::post('store', 'UsersController@store')->name('users.list.store');
    Route::get('find/user', 'UsersController@findUser')->name('users.find.user');

    /**
     * Place orders by manager
     */
    Route::namespace('Backend\\Http\\Controllers\\Users\\Orders')
                ->prefix('orders')
                ->name('users.orders.')
                ->group(function () {

        Route::get('', [Backend\Http\Controllers\Users\Orders\OrderController::class, 'index'])->name('index');
        Route::post('store', [Backend\Http\Controllers\Users\Orders\OrderController::class, 'store'])->name('store');
        Route::get('{product}/addProductTemplate', [Backend\Http\Controllers\Users\Orders\OrderController::class, 'addProductTemplate'])->name('addProductTemplate');

    });

});

