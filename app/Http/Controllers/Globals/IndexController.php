<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2018/5/11
 * Time: 2:38 PM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */

namespace App\Http\Controllers\Globals;


class IndexController extends GlobalController
{
    public function showIndex()
    {
        return view('Global.index');
    }

    public function showContact()
    {
        return view('global.contact');
    }
}