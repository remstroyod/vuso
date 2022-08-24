<?php

use Illuminate\Support\Facades\Route;

/**
 * Tags Group
 */
Route::group(
    [
        'prefix'        => '/tags',
        'middleware'    => 'auth',
        'namespace'     => 'Tags',
    ], function () {

    Route::get('/', 'TagsController@index')->name('tag.index');
    Route::post('/', 'TagsController@store')->name('tag.store');
    Route::get('/create', 'TagsController@create')->name('tag.create');
    Route::get('/{tag}/edit', 'TagsController@edit')->name('tag.edit');
    Route::post('/{tag}/update', 'TagsController@update')->name('tag.update');
    Route::delete('/{tag}/destroy', 'TagsController@destroy')->name('tag.destroy');

});

