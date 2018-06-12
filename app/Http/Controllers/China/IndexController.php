<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2018/5/11
 * Time: 2:38 PM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */

namespace App\Http\Controllers\China;


class IndexController extends ChinaController
{
    public function showIndex()
    {
        return redirect(route('globalIndex'));
//        return view('china.index');
    }
}