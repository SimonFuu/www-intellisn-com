<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2018/5/14
 * Time: 6:55 PM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */

namespace App\Http\Controllers\Globals;



use GeoIp2\Database\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends GlobalController
{

    public function showShoppingCart(Request $request)
    {
        $location = 'US';
        $reader = new Reader(storage_path('app/private/geoip/') . 'GeoLite2-Country.mmdb');
        try {
            $record = $reader -> country($request -> ip());
//            $location = $record->country->isoCode;
            $location = isset($this -> deliverCountries[$record->country->isoCode]) ? $record->country->isoCode : 'US';
        } catch (\Exception $e) {
            Log::warning('Get customer location error: ' . $e -> getMessage());
        }
        $countries = [
            "CN" => "China",
            "DE" => "Germany",
            "ES" => "Spain",
            "FR" => "France",
            "GB" => "United Kingdom",
            "HK" => "Hong Kong, China",
            "IT" => "Italy",
            "NL" => "Netherlands",
            "TW" => "Chinese Taiwan",
            "US" => "United States",
        ];
        return view('global.payment.cart', ['countries' => $countries, 'location' => $location]);
    }

    public function showCheckoutForm()
    {
        return view('global.payment.checkout');
    }

    public function checkoutSubmit(Request $request)
    {

        return redirect(route(SITE . 'CheckoutSuccess'));
    }

    public function checkoutSuccess()
    {
        return view('global.payment.success');
    }
}