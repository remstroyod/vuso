<?php
use Illuminate\Support\Facades\Route;

/**
 * Documents Group
 */
Route::middleware('auth')->group(function () {

    Route::prefix('e-documents')->name('edocuments.')->group(function() {

        Route::get('/', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsDocsController::class, 'index'])->name('index');
        Route::post('/', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsDocsController::class, 'store'])->name('store');
        Route::get('create', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsDocsController::class, 'create'])->name('create');
        Route::get('{document}/edit', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsDocsController::class, 'edit'])->name('edit');
        Route::post('{document}/update', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsDocsController::class, 'update'])->name('update');
        Route::delete('{document}/destroy', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsDocsController::class, 'destroy'])->name('destroy');

        Route::get('preview/{document}', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsDocsPreviewController::class, 'show'])->name('preview');

        Route::name('images.')->group(function() {
            Route::get('{document}/images', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsImagesController::class, 'index'])->name('index');
            Route::get('{document}/images/create', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsImagesController::class, 'create'])->name('create');
            Route::post('{document}/images', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsImagesController::class, 'store'])->name('store');
            Route::get('{document}/images/{image}/edit', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsImagesController::class, 'edit'])->name('edit');
            Route::delete('{document}/images/{image}/destroy', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsImagesController::class, 'destroy'])->name('destroy');
            Route::post('{document}/images/{image}/update', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsImagesController::class, 'update'])->name('update');
        });

        Route::name('type.')->prefix('type')->group(function () {
            Route::get('/', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsController::class, 'index'])->name('index');
            Route::post('/', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsController::class, 'store'])->name('store');
            Route::get('create', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsController::class, 'create'])->name('create');
            Route::get('{document}/edit', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsController::class, 'edit'])->name('edit');
            Route::post('{document}/update', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsController::class, 'update'])->name('update');
            Route::delete('{document}/destroy', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('placeholders')->name('placeholders.')->group(function () {
            Route::get('/', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsPlaceholdersController::class, 'index'])->name('index');
            Route::post('/', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsPlaceholdersController::class, 'store'])->name('store');
            Route::get('create', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsPlaceholdersController::class, 'create'])->name('create');
            Route::get('{placeholder}/edit', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsPlaceholdersController::class, 'edit'])->name('edit');
            Route::post('{placeholder}/update', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsPlaceholdersController::class, 'update'])->name('update');
            Route::delete('{placeholder}/destroy', [\Backend\Modules\EDocuments\Http\Controllers\EDocumentsPlaceholdersController::class, 'destroy'])->name('destroy');
        });
    });

});
