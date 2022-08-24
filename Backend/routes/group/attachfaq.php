<?php

use Illuminate\Support\Facades\Route;

/**
 * Attach Faq Pages Group
 */
Route::group(
    [
        'prefix'        => '/{page}/attach/faq',
        'middleware'    => 'auth',
        'namespace'     => 'Attachfaq',
    ], function () {

    /**
     * Attach Faq Pages
     */
    Route::get('/', 'AttachFaqController@index')->name('attach.faq.form');
    Route::post('/update', 'AttachFaqController@update')->name('attach.faq.update');

});

Route::group(
    [
        'prefix'        => '/{page}/attach/faq/category/{category}',
        'middleware'    => 'auth',
        'namespace'     => 'Attachfaq',
    ], function () {

    /**
     * Attach Faq Pages
     */
    Route::get('/', 'AttachFaqCatalogCategoryController@index')->name('attach.faq.catalog.category.form');
    Route::post('/update', 'AttachFaqCatalogCategoryController@update')->name('attach.faq.catalog.category.update');

});

