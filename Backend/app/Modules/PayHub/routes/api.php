<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')->name('api.')->group(function() {

    Route::prefix('v1')->name('v1.')->group(function() {

        Route::prefix('payhub')->name('payhub.')->group(function() {

            Route::name('payment.')->prefix('payment')->group(function() {
                Route::post('link-generate', [\Backend\Modules\PayHub\Http\Controllers\PaymentController::class, 'linkGenerate'])->name('link-generate');
                Route::post('cancel', [\Backend\Modules\PayHub\Http\Controllers\PaymentController::class, 'cancelPayment'])->name('cancel');
                Route::post('state', [\Backend\Modules\PayHub\Http\Controllers\PaymentController::class, 'paymentState'])->name('state');
                Route::post('pay-recurrent', [\Backend\Modules\PayHub\Http\Controllers\PaymentController::class, 'payRecurrent'])->name('pay-recurrent');
                Route::post('pay-to-card', [\Backend\Modules\PayHub\Http\Controllers\PaymentController::class, 'payToCard'])->name('pay-to-card');
            });

            Route::name('acquiring.')->prefix('acquiring')->group(function () {
                Route::post('get-response', [\Backend\Modules\PayHub\Http\Controllers\API\AcquiringController::class, 'getResponse'])->name('get-response');
                Route::post('get-receipt', [\Backend\Modules\PayHub\Http\Controllers\API\AcquiringController::class, 'getReceipt'])->name('get-receipt');
                Route::post('get-card-data', [\Backend\Modules\PayHub\Http\Controllers\API\AcquiringController::class, 'getCardData'])->name('get-card-data');
            });

            Route::match(['get', 'post'],'response/{service}/{response}', [\Backend\Modules\PayHub\Http\Controllers\API\ResponseController::class, 'response'])->name('webhook');
        });

    });

});
