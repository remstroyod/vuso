<?php

use Illuminate\Support\Facades\Route;

/**
 * Forms Page Group
 */
Route::group(
    [
        'prefix'        => '/forms',
        'middleware'    => 'auth',
        'namespace'     => 'Forms\\Data',
    ], function () {

    Route::get('/', 'DataController@index')->name('forms.data.index');
    Route::get('/{formsdata}/show', 'DataController@show')->name('forms.data.show');
    Route::delete('/{formsdata}/destroy', 'DataController@destroy')->name('forms.data.destroy');

});

