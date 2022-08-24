<?php

use Illuminate\Support\Facades\Route;

/**
 * FAQ Group
 */
Route::group(
    [
        'prefix'        => '/faq',
        'middleware'    => 'auth',
        'namespace'     => 'Faq',
    ], function () {

    /**
     * FAQ Page
     */
    Route::get('/edit', 'FaqController@edit')->name('faq.edit');
    Route::post('/{page}/update', 'FaqController@update')->name('faq.update');

    /**
     * FAQ List
     */
    Route::group(
        [
            'prefix'        => '/list',
        ], function () {

        Route::get('/', 'ListController@index')->name('faq.list.index');
        Route::post('/', 'ListController@store')->name('faq.list.store');
        Route::get('/create', 'ListController@create')->name('faq.list.create');
        Route::get('/{faq}/edit', 'ListController@edit')->name('faq.list.edit');
        Route::post('/{faq}/update', 'ListController@update')->name('faq.list.update');
        Route::delete('/{faq}/destroy', 'ListController@destroy')->name('faq.list.destroy');

    });

    /**
     * FAQ Categories
     */
    Route::group(
        [
            'prefix'        => '/categories',
        ], function () {

        Route::get('/', 'CategoriesController@index')->name('faq.categories.index');
        Route::post('/', 'CategoriesController@store')->name('faq.categories.store');
        Route::get('/create', 'CategoriesController@create')->name('faq.categories.create');
        Route::get('/{categories}/edit', 'CategoriesController@edit')->name('faq.categories.edit');
        Route::post('/{categories}/update', 'CategoriesController@update')->name('faq.categories.update');
        Route::delete('/{categories}/destroy', 'CategoriesController@destroy')->name('faq.categories.destroy');

    });

    /**
     * FAQ Seo Page
     */
    Route::group([
        'prefix'        => '/seo',
    ], function () {

        Route::get('/{id}', 'FaqController@seo')->name('faq.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('faq.seo.update');

    });

});

