<?php

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

Route::domain(config('domains.global'))
    -> group(function () {
        Route::group(['namespace' => 'Globals'], function () {
            Route::get('/', 'IndexController@showIndex') -> name('globalIndex');
            Route::get('/cart', 'CartController@showShoppingCart') -> name('globalShoppingCart');
            Route::get('/cart/add', 'CartController@storeAddingItemsToCart') -> name('globalAddingToShoppingCart');
            Route::post('/cart/update/delivery', 'CartController@updatingCartItems') -> name('globalUpdatingShoppingCartDelivery');
            Route::post('/cart/update/{sku}', 'CartController@updatingCartItems') -> name('globalUpdatingToShoppingCart');
            Route::get('/support/product/{id}', 'SupportController@showSupport') -> name('globalProductSupport');
            Route::get('/contact', 'ContactController@showIndex') -> name('globalContact');
            Route::post('/order/create', 'OrderController@create') -> name('globalCreateOrder');
            Route::get('/order/checkout/{id}', 'OrderController@showCheckoutForm') -> name('globalCheckoutForm');
            Route::get('/order/recheckout/{id}', 'OrderController@showReCheckoutForm') -> name('globalReCheckoutForm');
            Route::get('/order/inquiry', 'OrderController@showInquiryForm') -> name('globalOrderInquiryForm');
            Route::post('/pay/submit', 'PaymentController@checkoutSubmit') -> name('globalCheckout');
            Route::post('/pay/resubmit', 'PaymentController@checkoutReSubmit') -> name('globalReCheckout');
            Route::get('/pay/result', 'PaymentController@checkoutSuccess') -> name('globalCheckoutResult');
            Route::get('/product/{id}', 'ProductController@showIndex') -> name('globalProduct');
            Route::post('/product/sku/price', 'ProductController@getSKUPrice') -> name('globalQuerySKUPrice');
            Route::post('/subscription/store', 'IndexController@storeSubscription') -> name('globalStoreSubscription');
            Route::post('/payment/stripe/webhook', 'PaymentController@webhook');

        });
    });

Route::domain(config('domains.china'))
    -> group(function () {
        Route::group(['namespace' => 'China'], function () {
            Route::get('/', 'IndexController@showIndex') -> name('chinaIndex');
            Route::get('/product/{id}', 'ProductController@showIndex') -> name('chinaProduct');
            Route::get('/support/product/{id}', 'SupportController@showSupport') -> name('chinaProductSupport');
            Route::post('/subscription/store', 'IndexController@storeSubscription') -> name('chinaStoreSubscription');
        });
    });

Route::domain(config('domains.backend'))
    -> group(function () {
        Route::group(['namespace' => 'Backend'], function () {
            Route::get('/', 'IndexController@showIndex') -> name('backendIndex');
        });
    });
