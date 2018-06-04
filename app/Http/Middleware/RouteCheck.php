<?php

namespace App\Http\Middleware;

use Closure;

class RouteCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request -> isMethod('get')) {
            $routeName = $request -> route() -> getName();
            $site = $request -> route() -> getDomain();
            if ($site == config('domains.china')) {
                define('SECOND_HEADER', 'TEST Header');
            } elseif ($site == config('domains.backend')) {
                define('SECOND_HEADER', 'TEST Header');
            } else {
                $this -> set($routeName);

            }
        }
        return $next($request);
    }

    private function set($routeName = '')
    {
//        Route::get('/', 'IndexController@showIndex') -> name('global');
//        Route::get('/cart', 'CartController@showShoppingCart') -> name('global');
//        Route::get('/cart/add', 'CartController@storeAddingItemsToCart') -> name('globalAddingToShoppingCart');
//        Route::get('/support/product/{id}', 'SupportController@showSupport') -> name('global');
//        Route::get('/contact', 'ContactController@showIndex') -> name('globalContact');
//        Route::get('/order/checkout/{id}', 'OrderController@showCheckoutForm') -> name('globalCheckoutForm');
//        Route::get('/order/recheckout/{id}', 'OrderController@showReCheckoutForm') -> name('globalReCheckoutForm');
//        Route::get('/order/inquiry', 'OrderController@showInquiryForm') -> name('globalOrderInquiryForm');
//        Route::get('/pay/result', 'PaymentController@checkoutSuccess') -> name('globalCheckoutResult');
//        Route::get('/product/{id}', 'ProductController@showIndex') -> name('globalProduct');

        switch ($routeName) {
            case SITE . 'Index':
                define('SECOND_HEADER', 'Domilamp');
                break;
            case SITE . 'ShoppingCart':
                define('SECOND_HEADER', 'Cart');
                break;
            case SITE . 'AddingToShoppingCart':
                define('SECOND_HEADER', 'Adding Items');
                break;
            case SITE . 'ProductSupport':
                define('SECOND_HEADER', 'Support');
                break;
            case SITE . 'Contact':
                define('SECOND_HEADER', 'Contacting Intellisn');
                break;
            case SITE . 'CheckoutForm':
                define('SECOND_HEADER', 'Checkout');
                break;
            case SITE . 'ReCheckoutForm':
                define('SECOND_HEADER', 'Checkout');
                break;
            case SITE . 'OrderInquiryForm':
                define('SECOND_HEADER', 'Order Inquiry');
                break;
            case SITE . 'CheckoutResult':
                define('SECOND_HEADER', 'Checkout Result');
                break;
            case SITE . 'Product':
                define('SECOND_HEADER', 'Domilamp');
                break;
            default:
                define('SECOND_HEADER', 'Domilamp');  // 定义首页第二级 header
        }
    }
}
