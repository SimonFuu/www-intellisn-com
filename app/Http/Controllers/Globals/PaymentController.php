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


use Illuminate\Http\Request;

class PaymentController extends GlobalController
{
    protected function getProductDiscount($pid = 0)
    {

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