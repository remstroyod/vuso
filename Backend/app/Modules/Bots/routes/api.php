<?php


use Illuminate\Support\Facades\Route;

Route::name('api')->prefix('api')->group(function() {
    Route::name('v1')->prefix('v1')->group(function() {
        Route::name('bots')->prefix('bots')->group(function() {
            Route::match(['get', 'post'], 'webhook/{bot_type}', [\Backend\Modules\Bots\Http\Controllers\BotsController::class, 'webhook'])->name('webhook');
        });
    });
});