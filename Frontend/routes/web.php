<?php

use Frontend\Providers\Localization\LocalizationService;
use Illuminate\Support\Facades\Route;

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
$name_space = (new \ReflectionClass(\Frontend\Http\Controllers\Controller::class))->getNamespaceName();
Route::middleware('setLocale')->namespace($name_space)->prefix(LocalizationService::locale())->group(function() {
    Route::get('', [\Frontend\Http\Controllers\HomeController::class, 'index'])->name('home');

	Route::namespace('Auth')->group(function() {
        Route::prefix('login')->group(function() {
            Route::get('', [\Frontend\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
            Route::post('', [\Frontend\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
        });

        Route::prefix('register')->group(function() {
            Route::get('', [\Frontend\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm']);
            Route::post('', [\Frontend\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
        });

        Route::get('logout', [\Frontend\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

        Route::prefix('auth')->name('auth.')->group(function() {
            Route::get('{provider}', [\Frontend\Http\Controllers\Auth\AuthController::class, 'redirectToProvider'])->name('provider');
            Route::get('{provider}/callback', [\Frontend\Http\Controllers\Auth\AuthController::class, 'handleProviderCallback'])->name('provider.callback');

            Route::middleware('ajax')->group(function() {

                Route::prefix('web')->name('web.')->group(function() {
                    Route::get('refresh-token', [\Frontend\Http\Controllers\Auth\AuthController::class, 'refreshToken']);
                    Route::get('has-password', [\Frontend\Http\Controllers\Auth\AuthController::class, 'hasPassword']);

                    Route::prefix('sms')->name('sms.')->group(function() {
                        Route::post('', [\Frontend\Http\Controllers\Auth\AuthController::class, 'authPhone'])->name('phone');
                        Route::get('otp', [Frontend\Http\Controllers\API\v1\User\AuthController::class, 'sendOtp']);
                        Route::post('check', [\Frontend\Http\Controllers\Auth\AuthController::class, 'authPhoneCode'])->name('code');
                    });

                });

                Route::prefix('password')->group(function() {
                    Route::prefix('password')->name('enter.password.')->group(function() {
                        Route::post('enter', [\Frontend\Http\Controllers\Auth\AuthController::class, 'authEnterPasswordForm'])->name('form');
                        Route::post('check', [\Frontend\Http\Controllers\Auth\AuthController::class, 'authEnterPasswordCheck'])->name('check');
                    });

                    Route::post('create', [\Frontend\Http\Controllers\Auth\AuthController::class, 'authCreatePasswordForm'])->name('create.password.form');
                    Route::post('store', [\Frontend\Http\Controllers\Auth\AuthController::class, 'authCreatePasswordStore'])->name('store.password.form');
                    Route::post('change', [\Frontend\Http\Controllers\Auth\AuthController::class, 'authCreatePasswordViaPhone'])->name('store.password.via.phone');
                });
            });
        });
    });

    Route::namespace('Api\\v1')->prefix('web')->name('web.')->middleware('ajax')->middleware('auth')->group(function () {

        Route::namespace('Cart')->prefix('cart')->group(function () {
            Route::get('',                   [Frontend\Http\Controllers\API\v1\Cart\CartController::class, 'show'])->name('cart');
            Route::post('add/{product}',     [Frontend\Http\Controllers\API\v1\Cart\CartController::class, 'store'])->name('cart.add');
            Route::post('update/{product}',  [Frontend\Http\Controllers\API\v1\Cart\CartController::class, 'update'])->name('cart.update');
            Route::delete('destroy',[Frontend\Http\Controllers\API\v1\Cart\CartController::class, 'destroy'])->name('cart.destroy');
            Route::post('destroy/all',       [Frontend\Http\Controllers\API\v1\Cart\CartController::class, 'destroyAll'])->name('cart.destroy.all');
        });

        Route::prefix('promocode')->name('promocode.')->group(function () {
            Route::get('valid/{code}', [Frontend\Http\Controllers\API\v1\Promocode\PromocodeController::class, 'valid'])->name('valid');
            Route::get('apply/{code}', [Frontend\Http\Controllers\API\v1\Promocode\PromocodeController::class, 'apply'])->name('apply');
            Route::get('cancel', [Frontend\Http\Controllers\API\v1\Promocode\PromocodeController::class, 'cancel'])->name('cancel');
        });

        Route::prefix('user')->group(function () {
            Route::get('', [Frontend\Http\Controllers\API\v1\User\AuthController::class, 'getUser']);
            Route::get('sms/otp', [Frontend\Http\Controllers\API\v1\User\AuthController::class, 'sendOtp']);
            Route::post('sms/otp/resend', [Frontend\Http\Controllers\API\v1\User\AuthController::class, 'resendOtp']);

            Route::prefix('info')->group(function () {
                Route::get('vehicle', [Frontend\Http\Controllers\API\v1\User\InformationController::class, 'getVehicle']);
            });
        });

        Route::namespace('Payment')->prefix('payment')->group(function () {
            Route::get('pay', [Frontend\Http\Controllers\API\v1\Payment\PaymentController::class, 'payment']);
            Route::get('order-status/{contract}',         [Frontend\Http\Controllers\API\v1\Payment\PaymentController::class, 'orderStatus']);
            Route::get('order-receipt/{contract}',        [Frontend\Http\Controllers\API\v1\Payment\PaymentController::class, 'getReceipt']);
            Route::get('order-contract-share/{contract}', [Frontend\Http\Controllers\API\v1\Payment\PaymentController::class, 'orderContractShare']);
        });

        Route::prefix('integrity')->middleware('ajax')->middleware('auth')->group(function () {
            Route::post('search-car', [Backend\Modules\EDocuments\Http\Controllers\API\SearchController::class, 'searchCar']);
        });

    });

    // Route::namespace('Cart')->prefix('cart')->name('cart.')->middleware('auth')->group(function() {
    //     Route::delete('destroy/{product}', [\Frontend\Http\Controllers\Cart\CartController::class, 'destroy'])->name('web.destroy');
    // });

    Route::namespace('Profile')->prefix('profile')->name('profile')->middleware('auth')->group(function() {
        Route::get('',             [\Frontend\Http\Controllers\Profile\ProfileController::class, 'index']);
        Route::post('download-pdf/',[\Frontend\Http\Controllers\Profile\ProfileController::class, 'downloadPdf'])->middleware('ajax')->name('.downloadPdf');
        Route::get('edit',         [\Frontend\Http\Controllers\Profile\ProfileController::class, 'show'])->name('.edit');

        Route::prefix('person')->name('.person')->middleware('ajax')->group(function () {
            Route::post('save', [\Frontend\Http\Controllers\Profile\ProfileController::class, 'update'])->name('.save');

            Route::prefix('login-data')->name('.loginData')->group(function () {
                Route::post('check', [\Frontend\Http\Controllers\Profile\ProfileController::class, 'checkLoginData'])->name('.check');
                Route::post('save', [\Frontend\Http\Controllers\Profile\ProfileController::class, 'saveLoginData'])->name('.save');
            });
        });
    });

    Route::namespace('obj/insurance')->prefix('obj/insurance')->name('obj.insurance')->middleware('auth')->group(function() {
        Route::post('person/save', [\Frontend\Http\Controllers\Profile\ObjInsuranceController::class, 'createPerson'])->middleware('ajax')->name('.person.save');
        Route::post('person/update/{person}', [\Frontend\Http\Controllers\Profile\ObjInsuranceController::class, 'updatePerson'])->middleware('ajax')->name('.person.update');
        Route::post('car/save', [\Frontend\Http\Controllers\Profile\ObjInsuranceController::class, 'createCar'])->middleware('ajax')->name('.car.save');
        Route::post('car/update/{car}', [\Frontend\Http\Controllers\Profile\ObjInsuranceController::class, 'updateCar'])->middleware('ajax')->name('.car.update');
        Route::post('home/save', [\Frontend\Http\Controllers\Profile\ObjInsuranceController::class, 'createBuilding'])->middleware('ajax')->name('.home.save');
        Route::post('home/update/{building}', [\Frontend\Http\Controllers\Profile\ObjInsuranceController::class, 'updateBuilding'])->middleware('ajax')->name('.home.update');
    });

    Route::redirect('/blog', '/blog/news');
    Route::name('news.')->prefix('blog')->group(function() {
        Route::get('{category}', [\Frontend\Http\Controllers\NewsController::class, 'index'])->name('index');
        Route::get('{category}/{articles}', [\Frontend\Http\Controllers\NewsController::class, 'show'])->name('show');
    });

    Route::prefix('sales')->name('sales.')->group(function() {
        Route::get('', [\Frontend\Http\Controllers\SalesController::class, 'index'])->name('index');
        Route::get('{sale}', [\Frontend\Http\Controllers\SalesController::class, 'show'])->name('show');
    });

    Route::get('about', [\Frontend\Http\Controllers\AboutController::class, 'index'])->name('about.index');

    Route::get('basket', [\Frontend\Http\Controllers\Ecommerce\BasketController::class, 'index'])->name('basket.index');

    Route::prefix('partners')->name('partners.')->group(function() {
        Route::get('', [\Frontend\Http\Controllers\PartnersController::class, 'index'])->name('index');
        Route::get('partners/{categories}', 'PartnersController@category')->name('category');
    });

    Route::get('faq', [\Frontend\Http\Controllers\FaqController::class, 'index'])->name('faq.index');

    Route::prefix('contacts')->name('contacts.')->group(function() {
        Route::get('', [\Frontend\Http\Controllers\ContactsController::class, 'index'])->name('index');
        Route::get('{countries}', [\Frontend\Http\Controllers\ContactsController::class, 'show'])->name('city');
    });

    Route::get('payments-delivery', [\Frontend\Http\Controllers\PaymentsDeliveryController::class, 'index'])->name('payment_delivery.index');

    Route::get('informations', [\Frontend\Http\Controllers\InformationsController::class, 'index'])->name('informations.index');

    Route::get('support', [\Frontend\Http\Controllers\SupportController::class, 'index'])->name('support.index');

    Route::get('landing-page/{pages}', [\Frontend\Http\Controllers\ConstructorController::class, 'index'])->name('landing.page');

    Route::namespace('Catalog')->group(function() {
        Route::name('catalog.')->group(function(){
            Route::prefix('catalog')->group(function() {
                Route::get('', [\Frontend\Http\Controllers\Catalog\CatalogController::class, 'index'])->name('index');
                Route::get('{contragents}', [\Frontend\Http\Controllers\Catalog\CatalogController::class, 'contragents'])->name('contragents.index');
                Route::get('{contragents}/{category}', [\Frontend\Http\Controllers\Catalog\CatalogController::class, 'category'])->name('category.index');
            });

            Route::get('product/{product}', [\Frontend\Http\Controllers\Catalog\CatalogController::class, 'show'])->name('product.index');
        });

        Route::prefix('b2b')->name('b2b.')->group(function() {
            Route::get('', [\Frontend\Http\Controllers\Catalog\CatalogB2BController::class, 'index'])->name('index');
            Route::get('{category}', [\Frontend\Http\Controllers\Catalog\CatalogB2BController::class, 'category'])->name('category.index');
            Route::get('product/{category}/{product}', [\Frontend\Http\Controllers\Catalog\CatalogB2BController::class, 'show'])->name('product.index');
        });
    });

    Route::get('search', [\Frontend\Http\Controllers\SearchController::class, 'index'])->name('search');

    Route::prefix('payment')->name('payment.')->group(function() {
        Route::get('', [\Frontend\Http\Controllers\PaymentController::class, 'index'])->name('index');
        Route::post('', [\Frontend\Http\Controllers\PaymentController::class, 'checkContract'])->middleware('ajax')->name('check.contract');

        Route::get('pay/{contract}/success', [\Frontend\Http\Controllers\PaymentController::class, 'success'])->name('success');
        Route::get('pay/{contract}/error', [\Frontend\Http\Controllers\PaymentController::class, 'error'])->name('error');

        Route::prefix('status')->group(function() {
            Route::get('success', [\Frontend\Http\Controllers\PaymentController::class, 'successRender'])->name('success.render');
            Route::get('error', [\Frontend\Http\Controllers\PaymentController::class, 'errorRender'])->name('error.render');
        });

        Route::post('process/{user}/{contract}', [\Frontend\Http\Controllers\PaymentController::class, 'process'])->middleware('ajax')->name('process');
        Route::post('buy-insurance/{id}', [\Frontend\Http\Controllers\PaymentController::class, 'buy'])->name('buy-insurance');
    });

    Route::post('forms', [\Frontend\Http\Controllers\FormsController::class, 'store'])->middleware('ajax')->name('forms.store');

    Route::get('s/{slug}/{subslug?}', [\Frontend\Http\Controllers\StaticPagesController::class, 'index'])->name('static.pages.index');

    Route::get('document/get/{document}', [\Frontend\Http\Controllers\EDocuments\EDocumentsController::class, 'show'])->name('edocuments.get.file');
});

Route::prefix('web')->middleware('ajax')->middleware('auth')->group(function () {

    Route::prefix('calculator')->group(function () {

        Route::post('calculate-insurance/{product}',[Backend\Modules\EDocuments\Http\Controllers\API\CalculatorController::class, 'calculate']);
        Route::post('save-insurance/{product}',     [Backend\Modules\EDocuments\Http\Controllers\API\CalculatorController::class, 'save']);
        Route::post('buy-insurance/{product}',      [Backend\Modules\EDocuments\Http\Controllers\API\CalculatorController::class, 'buy']);

    });

});
