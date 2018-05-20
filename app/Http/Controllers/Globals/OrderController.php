<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2018/5/18
 * Time: 4:55 PM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */

namespace App\Http\Controllers\Globals;


use Illuminate\Http\Request;

class OrderController extends GlobalController
{
    public function showInquiryForm(Request $request)
    {
        if ($request -> has('email') && $request -> has('order_number')) {
            return view('global.orders.detail');
        } else {
            return view('global.orders.inquiry');
        }
    }
}