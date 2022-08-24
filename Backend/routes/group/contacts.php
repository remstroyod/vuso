<?php

use Illuminate\Support\Facades\Route;

/**
 * Contacts Group
 */
Route::group(
    [
        'prefix'        => '/contacts',
        'middleware'    => 'auth',
        'namespace'     => 'Contacts',
    ], function () {

    /**
     * Contacts Page
     */
    Route::get('/edit', 'ContactsController@edit')->name('contacts.edit');
    Route::post('/{page}/update', 'ContactsController@update')->name('contacts.update');

    /**
     * Contacts Offices Page
     */
    Route::group([
        'prefix'        => '/offices',
    ], function () {

        Route::get('/', 'OfficesController@index')->name('contacts.offices.index');
        Route::post('/', 'OfficesController@store')->name('contacts.offices.store');
        Route::get('/create', 'OfficesController@create')->name('contacts.offices.create');
        Route::delete('/{offices}/destroy', 'OfficesController@destroy')->name('contacts.offices.destroy');
        Route::get('/{offices}/edit', 'OfficesController@edit')->name('contacts.offices.edit');
        Route::post('/{offices}/update', 'OfficesController@update')->name('contacts.offices.update');

    });

    /**
     * Contacts Countries Page
     */
    Route::group([
        'prefix'        => '/countries',
    ], function () {

        Route::get('/', 'CountriesController@index')->name('contacts.countries.index');
        Route::post('/', 'CountriesController@store')->name('contacts.countries.store');
        Route::get('/create', 'CountriesController@create')->name('contacts.countries.create');
        Route::delete('/{countries}/destroy', 'CountriesController@destroy')->name('contacts.countries.destroy');
        Route::get('/{countries}/edit', 'CountriesController@edit')->name('contacts.countries.edit');
        Route::post('/{countries}/update', 'CountriesController@update')->name('contacts.countries.update');

    });

    /**
     * Contacts Seo Page
     */
    Route::group([
        'prefix'        => '/seo',
    ], function () {

        Route::get('/{id}', 'ContactsController@seo')->name('contacts.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('contacts.seo.update');

    });

});

