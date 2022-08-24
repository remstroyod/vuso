<?php

use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], 'api/v1/edocuments/google/drive-webhook', function(\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Storage::disk('google')->put('test.txt', 'Hello World');

    \Backend\Models\Log::debug($request->all(), __LINE__, __FILE__);
    return response()->json(['status' => true]);
});

Route::group(
    [
        'prefix'        => 'api/v1/edocuments',
//        'middleware'    => ['api', 'authApi'],
        'namespace'     => 'API',
    ],
    function () {
        /**
         * Create Document
         */
        Route::post('/store', 'ApiController@store');

        /**
         * Destroy Document
         */
        Route::delete('/destroy/{dogovor_id}', 'ApiController@destroy');

        /**
         * Get All Documents and Folder
         */
        Route::get('/', 'ApiController@index');

        /**
         * Get One Document by Number of Contract
         */
        Route::get('/show/{id}', 'ApiController@show');

        /**
         * Documents by User ID
         */
        Route::get('/user/{id}', 'ApiController@user');

        /**
         * Documents System
         */
        Route::get('/system/documents', 'ApiController@system_documents');

        /**
         * Documents System
         */
        Route::get('/system/templates', 'ApiController@system_templates');


        /**
         * Generation Document
         */
        Route::post('/product/{product}', [\Backend\Modules\EDocuments\Http\Controllers\API\DocumentController::class, 'store']);
        Route::post('/store/data/{document}', 'DocumentController@storeDogovorInformation');

        /**
         * is Payment Document
         */
        Route::get('/payment/{document}', 'ApiController@isPaymentDocument');

        /*
         * Calculation
         */
        Route::post('/calculator/calculate-insurance/{product}', 'CalculatorController@calculate');
        Route::post('/calculator/save-insurance/{product}', 'CalculatorController@save');
        Route::post('/calculator/buy-insurance/{product}', 'CalculatorController@buy');

    }
);
