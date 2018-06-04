<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * @param Request $request
     */
    public function boot(Request $request)
    {
        if ($request -> header('host') == config('domains.china')) {
            define('SITE', 'china');
            $this -> defineCDNServers('china');
        } elseif ($request -> header('host') == config('domains.backend')) {
            define('SITE', 'backend');
            $this -> defineCDNServers('backend');
        } else {
            define('SITE', 'global');
            $this -> defineCDNServers('global');
        }

        if (!$request -> ajax()) {
            $this -> countCartNumber();
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    private function defineCDNServers($site = 'global')
    {
        if (config('app.env') == 'production') {
            define('CDN_SERVER', config('app.cdn.' . $site));
        } else {
            define('CDN_SERVER', '');
        }
    }

    private function countCartNumber()
    {
        view() -> composer('layouts.headers.first', function($view) {
            $cart = Cookie::get('cart');
            if ($cart) {
                try {
                    if (substr($cart, 0 ,1) !== '{') {
                        $cart = decrypt($cart);
                    }
                    $cartItems = json_decode($cart, true);
                } catch (\Exception $e) {
                    Log::warning('购物车反序列化失败！' . $e -> getMessage());
                    $cartItems = [];
                }
                $count = count($cartItems);

            } else {
                $count = 0;
            }
            $view -> with('cartItemsCount', $count === 0 ? '' : ($count > 9 ? '9+' : $count));
        });
    }
}
