<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2018/6/5
 * Time: 6:18 PM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */

namespace App\Http\Controllers\China;


class SupportController extends ChinaController
{
    public function showSupport($product = '')
    {
        return view('china.domilamp.help');

    }
}