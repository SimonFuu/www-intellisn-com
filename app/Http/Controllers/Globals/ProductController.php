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


use Illuminate\Support\Facades\DB;

class ProductController extends GlobalController
{
    public function showIndex($id = '6402415426629795841')
    {

//        $product = DB::table('products')
//            -> select('*')
//            -> where('is_delete', 0)
//            -> first();
//        if ($id == 0 || is_null($product)) {
//            return abort(404);
//        }
//        return view('global.products.detail', ['product' => $product, 'productId' => $id]);
        return view('global.products.detail');
    }
}