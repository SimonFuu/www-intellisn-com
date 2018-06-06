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
                $this -> setChinaHeader($routeName);
            } elseif ($site == config('domains.backend')) {
                define('SECOND_HEADER', 'TEST Header');
            } else {
                $this -> setGlobalHeader($routeName);

            }
        }
        return $next($request);
    }

    private function setChinaHeader($routeName = '')
    {
//        Route::get('/', 'IndexController@showIndex') -> name('chinaIndex');
//        Route::get('/product/{id}', 'ProductController@showIndex') -> name('chinaProduct');

        switch ($routeName) {
            case SITE . 'Index':
                define('SECOND_HEADER', 'Domilamp');
                break;
            case SITE . 'ProductSupport':
                define('SECOND_HEADER', ' 支持');
                break;
            default:
                define('SECOND_HEADER', 'Domilamp');  // 定义首页第二级 header
        }
    }

    private function setGlobalHeader($routeName = '')
    {
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
