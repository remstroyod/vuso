<?php

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
Route::namespace('Backend\\Http\\Controllers\\API\\v1')->prefix('v1')->middleware('api')->group(function () {

    //Route::middleware('authApi')->group(function () {

        Route::namespace('Catalog')->prefix('catalog')->group(function () {
            Route::get('/', [\Backend\Http\Controllers\API\v1\Catalog\ProductController::class, 'index'])->name('catalog');

            Route::prefix('product')->group(function() {
                Route::get('{product}', [\Backend\Http\Controllers\API\v1\Catalog\ProductController::class, 'show'])->name('catalog.product.get');
                Route::post('{product}/update', [\Backend\Http\Controllers\API\v1\Catalog\ProductController::class, 'update'])->name('catalog.product.update');
            });
        });

        Route::namespace('User')->prefix('user')->group(function () {
            Route::get('{user}', [\Backend\Http\Controllers\API\v1\User\UserController::class, 'show'])->name('api.user');
            Route::get('find/user', [\Backend\Http\Controllers\API\v1\User\UserController::class, 'findUser'])->name('api.user.find');
        });

        Route::namespace('Files')->prefix('files')->group(function () {
            Route::post('upload', [\Backend\Http\Controllers\API\v1\Files\FilesController::class, 'store'])->name('api.file.upload');
        });

        Route::namespace('Page')->prefix('page')->group(function () {
            Route::get('{page}', [\Backend\Http\Controllers\API\v1\Page\PageController::class, 'show'])->name('page.get');
            Route::post('update/{page}', [\Backend\Http\Controllers\API\v1\Page\PageController::class, 'update'])->name('page.update');
        });

        Route::namespace('Dictionaries')->prefix('dictionaries')->name('dictionaries.')->group(function () {
            Route::get('countries', [\Backend\Http\Controllers\API\v1\Dictionaries\CountryController::class, 'countries'])->name('countries');
            Route::get('car/auto-categories', [\Backend\Http\Controllers\API\v1\Dictionaries\CarController::class, 'autoCategories'])->name('car.auto-categories');

            Route::prefix('autoria')->name('autoria.')->group(function () {
                Route::get('mark', [\Backend\Http\Controllers\API\v1\Dictionaries\AutoriaController::class, 'mark'])->name('mark');
                Route::get('models', [\Backend\Http\Controllers\API\v1\Dictionaries\AutoriaController::class, 'models'])->name('models');
                Route::get('transmissions', [\Backend\Http\Controllers\API\v1\Dictionaries\AutoriaController::class, 'transmissions'])->name('transmissions');
                Route::get('tstype', [\Backend\Http\Controllers\API\v1\Dictionaries\AutoriaController::class, 'tstype'])->name('tstype');
            });

            Route::prefix('ewa')->name('ewa.')->group(function () {
                Route::get('city', [\Backend\Http\Controllers\API\v1\Dictionaries\EwaController::class, 'city'])->name('city');
                Route::get('mark', [\Backend\Http\Controllers\API\v1\Dictionaries\EwaController::class, 'mark'])->name('mark');
                Route::get('models', [\Backend\Http\Controllers\API\v1\Dictionaries\EwaController::class, 'models'])->name('models');
            });

            Route::prefix('mtsbu')->name('mtsbu.')->group(function () {
                Route::get('city', [\Backend\Http\Controllers\API\v1\Dictionaries\MtsbuController::class, 'cities'])->name('cities');
            });
        });

    //});

    Route::namespace('Integrations')->prefix('dia')->group(function() {
        Route::get('', [\Backend\Http\Controllers\API\v1\Integrations\DiaController::class, 'index'])->name('api.dia.index');

        Route::post('ping', function (\Illuminate\Http\Request $request) {
            \Backend\Models\Log::debug($request->all(), __LINE__, __FILE__);

            return response()->json(["success" => true]);
        })->name('dia.ping');
    });

});


