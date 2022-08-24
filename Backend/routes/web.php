<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth::routes();
Route::group(
    [
        'prefix'        => '/',
        'namespace' => 'Backend\\Http\\Controllers\\Auth',
    ],
    function ()
    {

        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register');
        Route::get('logout', 'LoginController@logout')->name('logout');

    }
);
Route::group(
    [
        'prefix'        => '/',
        'middleware' => 'auth',
        'namespace' => 'Backend\\Http\\Controllers',
    ],
    function () {

        /**
         * Set Locale
         */
        Route::get('locale/{locale}', 'LocalizationController@index')->name('localization');

        /**
         * Home Dashboard
         */
        Route::get('/', 'DashboardController@index')->name('dashboard');

    }
);
//Route::group(['middleware' => 'role:web-developer'], function() {
//    Route::get('/dashboard', function() {
//        return 'Добро пожаловать, Веб-разработчик';
//    });
//});


