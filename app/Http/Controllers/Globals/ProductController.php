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
use Illuminate\Support\Facades\DB;

class ProductController extends GlobalController
{
    /**
     * 展示产品页面
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showIndex($id = 0)
    {
        $product = DB::table('products')
            -> select('*')
            -> where('is_delete', 0)
            -> where('id', $id)
            -> first();
        if ($id == 0 || is_null($product)) {
            return abort(404);
        }
        $thumbs = DB::table('products_more')
            -> select('*')
            -> where('is_delete', 0) -> where('p_id', $id) -> where('type', 0)
            -> get();
        $spu = DB::table('products_spu')
            -> select('*')
            -> where('is_delete', 0) -> where('p_id', $id)
            -> get();
        $options = DB::table('products_options')
            -> select('products_options.id', 'products_options.thumb', 'products_options.name', 'products_options.g_id', 'products_option_groups.group_name')
            -> leftJoin('products_option_groups', 'products_option_groups.id', '=', 'products_options.g_id')
            -> where('products_options.p_id', $id) -> where('products_options.is_delete', 0)
            -> get();
        $priceInfo = DB::table('products_price')
            -> select('price', 'currency', 'cur_symbol')
            -> where('p_id', $id) -> where('is_delete', 0)
            -> first();
        $spu = $spu -> isNotEmpty() ? $spu : [];
        $thumbs = $thumbs -> isNotEmpty() ? $thumbs : [];
        $ops = [];
        if ($options -> isNotEmpty()) {
            foreach ($options as $option) {
                $ops[$option -> group_name][] = $option;
            }
        } else {
            $ops = [];
        }
        $product -> thumbs = $thumbs;
        $product -> spu = $spu;
        $product -> options = $ops;
        $product -> price = is_null($priceInfo) ? [] : $priceInfo;
        return view('global.products.detail', ['product' => $product]);
    }

    /**
     * 通过ajax获取SKU价格
     * @param Request $request
     * @return array
     */
    public function getSKUPrice(Request $request)
    {
        if ($request -> ajax() && $request -> has('is_ajax') && $request -> is_ajax) {
            if ($request -> has('p_id') && $request -> has('options') && is_array($request -> options)) {
                $options = $request -> options;
                asort($options);
                $sku = md5(implode('+', $options));
                $price = DB::table('products_sku') -> select('price', 'currency', 'cur_symbol', 'sku')
                    -> where('is_delete', 0) -> where('mark', $sku)
                    -> where('p_id', $request -> p_id) -> first();
                if ($price) {
                    $response = $this -> ajaxResponse(true, true, 'success.', $price);
                } else {
                    $response = $this -> ajaxResponse(true, false, 'Ger price error.', []);
                }
            } else {
                $response = $this -> ajaxResponse(true, false, 'Invalid params.', []);

            }
        } else {
            $response = $this -> ajaxResponse(false, false, 'Invalid request.', []);
        }
        return $response;
    }
}