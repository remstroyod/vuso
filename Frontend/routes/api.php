<?php

use Frontend\Http\Controllers\API\v1\Dictionaries\AutoriaController;
use Frontend\Http\Controllers\API\v1\Dictionaries\CarController;
use Frontend\Http\Controllers\API\v1\Dictionaries\CountryController;
use Frontend\Http\Controllers\API\v1\Dictionaries\EwaController;
use Frontend\Http\Controllers\API\v1\Dictionaries\MtsbuController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Frontend\\Http\\Controllers\\API\\v1')->prefix('v1')->middleware('api')->group(function () {
    Route::namespace('Cart')->prefix('cart')->group(function () {
        Route::get('/', 'CartController@show')->name('cart');
        Route::post('/add/{product}', 'CartController@store')->name('cart.add');
        Route::post('/destroy/{product}', 'CartController@destroy')->name('cart.destroy');
        Route::post('/update/{product}', 'CartController@update')->name('cart.update');
        Route::get('/total', 'CartController@cartTotal')->name('cart.total');
        Route::get('/subtotal', 'CartController@cartSubTotal')->name('cart.subtotal');
        Route::get('/quantity', 'CartController@cartQuantity')->name('cart.quantity');
        Route::post('/clear', 'CartController@clear')->name('cart.clear');
    });

    Route::namespace('User')->prefix('user')->group(function () {
        Route::get('sms',      [Frontend\Http\Controllers\API\v1\User\AuthController::class, 'sendSms']);
        Route::get('sms/auth', [Frontend\Http\Controllers\API\v1\User\AuthController::class, 'authPhoneCode']);
        Route::get('sms/otp',  [Frontend\Http\Controllers\API\v1\User\AuthController::class, 'sendOtp']);
    });

    Route::namespace('Promocode')->prefix('promocode')->group(function () {
        Route::get('valid/{code}', 'PromocodeController@valid')->name('promocode.valid');
        Route::get('apply/{code}', [Frontend\Http\Controllers\API\v1\Promocode\PromocodeController::class, 'apply'])->name('promocode.apply');
    });

    Route::namespace('Payment')->prefix('payment')->group(function () {
        Route::get('pay', [Frontend\Http\Controllers\API\v1\Payment\PaymentController::class, 'payment'])->name('api.v1.payment.pay');
        Route::get('order-status', [Frontend\Http\Controllers\API\v1\Payment\PaymentController::class, 'orderStatus']);
    });

    Route::namespace('Dictionaries')->prefix('dictionaries')->name('dictionaries.')->group(function () {
        Route::get('countries', [CountryController::class, 'countries'])->name('countries');
        Route::get('cities-by-country', [CountryController::class, 'citiesByCountry'])->name('citesByCountry');
        Route::get('car/auto-categories', [CarController::class, 'autoCategories'])->name('car.auto-categories');

        Route::prefix('autoria')->name('autoria.')->group(function () {
            Route::get('mark', [AutoriaController::class, 'mark'])->name('mark');
            Route::get('models', [AutoriaController::class, 'models'])->name('models');
            Route::get('transmissions', [AutoriaController::class, 'transmissions'])->name('transmissions');
            Route::get('tstype', [AutoriaController::class, 'tstype'])->name('tstype');
        });

        Route::prefix('ewa')->name('ewa.')->group(function () {
            Route::get('city', [EwaController::class, 'city'])->name('city');
        });
    });

});

Route::prefix('api')->name('api.')->group(function() {
    Route::prefix('v1')->name('v1.')->group(function () {
        Route::prefix('payhub')->name('payhub.')->group(function () {
            Route::match(['get', 'post'], 'response/{service}/{response}', [\Backend\Modules\PayHub\Http\Controllers\API\ResponseController::class, 'response'])->name('webhook');
        });
    });
});
