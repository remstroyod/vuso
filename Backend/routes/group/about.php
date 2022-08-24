<?php

use Illuminate\Support\Facades\Route;

/**
 * About Group
 */
Route::group(
    [
        'prefix'        => '/about',
        'middleware'    => 'auth',
        'namespace'     => 'About',
    ], function () {

    /**
     * About Page
     */
    Route::get('/edit', 'AboutController@edit')->name('about.edit');
    Route::post('/{page}/update', 'AboutController@update')->name('about.update');

    /**
     * About History Page
     */
    Route::group([
        'prefix'        => '/history',
    ], function () {

        Route::get('/', 'HistoryController@index')->name('about.history.index');
        Route::post('/', 'HistoryController@store')->name('about.history.store');
        Route::get('/create', 'HistoryController@create')->name('about.history.create');
        Route::delete('/{history}/destroy', 'HistoryController@destroy')->name('about.history.destroy');
        Route::get('/{history}/edit', 'HistoryController@edit')->name('about.history.edit');
        Route::post('/{history}/update', 'HistoryController@update')->name('about.history.update');

    });

    /**
     * About Team Page
     */
    Route::group([
        'prefix'        => '/team',
    ], function () {

        Route::get('/', 'TeamController@index')->name('about.team.index');
        Route::post('/', 'TeamController@store')->name('about.team.store');
        Route::get('/create', 'TeamController@create')->name('about.team.create');
        Route::delete('/{team}/destroy', 'TeamController@destroy')->name('about.team.destroy');
        Route::get('/{team}/edit', 'TeamController@edit')->name('about.team.edit');
        Route::post('/{team}/update', 'TeamController@update')->name('about.team.update');

    });

    /**
     * About Awards Page
     */
    Route::group([
        'prefix'        => '/awards',
    ], function () {

        Route::get('/', [Backend\Http\Controllers\About\AwardsController::class, 'index'])->name('about.awards.index');
        Route::post('/', 'AwardsController@store')->name('about.awards.store');
        Route::get('/create', 'AwardsController@create')->name('about.awards.create');
        Route::delete('/{awards}/destroy', 'AwardsController@destroy')->name('about.awards.destroy');
        Route::get('/{awards}/edit', 'AwardsController@edit')->name('about.awards.edit');
        Route::post('/{awards}/update', 'AwardsController@update')->name('about.awards.update');

    });

    /**
     * About Seo Page
     */
    Route::group([
        'prefix'        => '/seo',
    ], function () {

        Route::get('/{id}', 'AboutController@seo')->name('about.seo');
        Route::post('/{pages}/update', [Backend\Http\Controllers\SeoController::class, 'update'])->name('about.seo.update');

    });

});

