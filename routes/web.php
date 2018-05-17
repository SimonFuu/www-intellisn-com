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
            Route::get('/contact', 'IndexController@showContact') -> name('globalProduct');
            Route::get('/product/{id}', 'ProductController@showIndex') -> name('globalProduct');
            Route::get('/cart', 'PaymentController@showShoppingCart') -> name('globalShoppingCart');
            Route::get('/contact', 'ContactController@showIndex') -> name('globalContact');
            Route::get('/checkout', 'PaymentController@showCheckoutForm') -> name('globalCheckoutForm');
            Route::post('/checkout/submit', 'PaymentController@checkoutSubmit') -> name('globalCheckout');
            Route::get('/checkout/success', 'PaymentController@checkoutSuccess') -> name('globalCheckoutSuccess');
        });
    });

Route::domain(config('domains.china'))
    -> group(function () {
        Route::group(['namespace' => 'China'], function () {
            Route::get('/', 'IndexController@showIndex') -> name('chinaIndex');
            Route::get('/product/{id}', 'ProductController@showIndex') -> name('chinaProduct');
        });
    });

Route::domain(config('domains.backend'))
    -> group(function () {
        Route::group(['namespace' => 'Backend'], function () {
            Route::get('/', 'IndexController@showIndex') -> name('backendIndex');
        });
    });
