<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2018/5/25
 * Time: 2:39 PM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */

namespace App\Http\Controllers\Globals;


class SupportController extends GlobalController
{
    public function showSupport($id = 0)
    {
        return view('global.support.support');
    }
}