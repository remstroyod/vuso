<?php

use Illuminate\Support\Facades\Route;

/**
 * Documentation Group
 */
Route::group(
    [
        'prefix'        => '/documentation',
        'middleware'    => 'auth',
        'namespace'     => 'Documentation',
    ], function () {

    Route::get('/', 'DocumentationController@index')->name('documentation.index');

});

