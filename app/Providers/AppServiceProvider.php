<?php

namespace App\Providers;

use Illuminate\Http\Request;
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
}
