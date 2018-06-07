<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2018/5/21
 * Time: 5:26 PM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */

namespace App\Http\Controllers\Globals;


use GeoIp2\Database\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends GlobalController
{
    /**
     * 购物车页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showShoppingCart(Request $request)
    {
        if (Cookie::has('cart')) {
            $location = 'US';
            $reader = new Reader(storage_path('app/private/geoip/') . 'GeoLite2-Country.mmdb');
            try {
                $record = $reader -> country($request -> ip());
//            $location = $record->country->isoCode;
                $location = isset($this -> deliveryCountries[$record->country->isoCode]) ? $record->country->isoCode : 'US';
            } catch (\Exception $e) {
                Log::warning('Get customer location error: ' . $e -> getMessage());
            }
            $items = json_decode(Cookie::get('cart'));
            $cur_symbol = '$';
            foreach ($items as $item) {
                $cur_symbol = $item -> cur_symbol;
            }
            $subtotal = $this -> subtotalCounting($items);
            $checkoutAmount = $this -> itemsCheckoutAmountCounting($items);
            $discount = $subtotal - $checkoutAmount;
            $shippingAmount = $this -> getShippingAmount($location, $items);
            return view('global.payment.cart', [
                'items' => $items,
                'countries' => $this -> deliveryCountries,
                'location' => $location,
                'price' => [
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'shipping' => $shippingAmount,
                    'total' => $shippingAmount + $checkoutAmount,
                    'cur_symbol' => $cur_symbol
                ]
            ]);
        } else {
            Cookie::queue(Cookie::forget('cart'));
            return view('global.payment.cart');
        }
    }

    /**
     * 添加购物车操作
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function storeAddingItemsToCart(Request $request)
    {
        if ($request -> has('product')) {
            if (($product = json_decode(base64_decode($request -> product), true)) === false) {
                // Base 64 解码失败
                return view('global.payment.addToCart', [
                    'result' => false,
                    'message' => 'Failed to add the product to the shopping cart, code 1',
                    'cartItemsCount' => -1
                ]);
            } else {
                // 解码成功
                if (isset($product['product']) && isset($product['option']) && is_array($product['option'])) {
                    if (count($product['option']) == 1) {
                        $sku = md5($product['option'][0]);
                    } else {
                        asort($product['option']);
                        $sku = md5(implode('+', $product['option']));
                    }
                    $currentCartItems = json_decode(Cookie::get('cart'), true);
                    if (isset($currentCartItems[$sku])) {
                        $currentCartItems[$sku]['count'] += 1;
                    } else {
                        $price = DB::table('products_sku')
                            -> select('price', 'name', 'cur_symbol', 'thumb')
                            -> where('is_delete', 0) -> where('mark', $sku) -> where('p_id', $product['product'])
                            -> first();
                        $p = DB::table('products')
                            -> select('name', 'thumb')
                            -> where('is_delete', 0) -> where('id', $product['product'])
                            -> first();
                        if ($price && $p) {
                            $currentCartItems[$sku] = [
                                'price' => $price -> price,
                                'thumb' => $price -> thumb,
                                'product' => $p -> name,
                                'product_id' => $product['product'],
                                'sku_name' => $price -> name,
                                'count' => 1,
                                'cur_symbol' => $price -> cur_symbol,
                            ];
                        } else {
                            // 产品未发现
                            return view('global.payment.addToCart', [
                                'result' => false,
                                'message' => 'Failed to add the product to the shopping cart, code 3',
                                'cartItemsCount' => -1
                            ]);
                        }
                    }
                } else {
                    // 关键参数不存在
                    return view('global.payment.addToCart', [
                        'result' => false,
                        'message' => 'Failed to add the product to the shopping cart, code 2',
                        'cartItemsCount' => -1
                    ]);
                }
                Cookie::queue('cart', json_encode($currentCartItems), 1440);
                return redirect(route(SITE . 'ShoppingCart'));
//                return view('global.payment.addToCart', [
//                    'result' => true, 'message' => '添加产品成功！',
//                    'cartItemsCount' => count($currentCartItems),
//                ]);
            }
        } else {
            // 不存在 Product 参数
            return view('global.payment.addToCart', [
                'result' => false,
                'message' => 'Failed to add the product to the shopping cart, code 0.',
                'cartItemsCount' => -1,
            ]);
        }
    }

    /**
     * 更新购物车操作
     * @param Request $request
     * @param int $sku
     * @return array
     */
    public function updatingCartItems(Request $request, $sku = 0)
    {
        if (Cookie::has('cart') && $sku === 0 && $request -> has('delivery')) {
            // 更新收件国家
            $items = json_decode(Cookie::get('cart'));
            foreach ($items as $item) {
                $curSymbol = $item -> cur_symbol;
            }

            $subtotal = $this -> subtotalCounting($items);
            $checkoutAmount = $this -> itemsCheckoutAmountCounting($items);
            $discount = $subtotal - $checkoutAmount;
            $shippingAmount = $this -> getShippingAmount($request -> delivery, $items);
            return $this -> ajaxResponse(true, true, 'success.', [
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping' => $shippingAmount,
                'total' => $shippingAmount + $checkoutAmount,
                'cur_symbol' => $curSymbol
            ]);
        } elseif (
            Cookie::has('cart') &&
            ($request -> has('count') || $request -> has('action')) &&
            $request -> has('delivery')
        ) {
            // 更新产品数量
            $items = json_decode(Cookie::get('cart'), true);
            if (isset($items[$sku]) && $request -> has('count') && $request -> count <= 99 && $request -> count >= 1) {
                $items[$sku]['count'] = $request -> count;
                $items = json_encode($items);
                Cookie::queue('cart', $items, 1440);
                $items =json_decode($items);
                $subtotal = $this -> subtotalCounting($items);
                $checkoutAmount = $this -> itemsCheckoutAmountCounting($items);
                $discount = $subtotal - $checkoutAmount;
                $shippingAmount = $this -> getShippingAmount($request -> delivery, $items);
                return $this -> ajaxResponse(true, true, 'success.', [
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'shipping' => $shippingAmount,
                    'total' => $shippingAmount + $checkoutAmount,
                    'cur_symbol' => $items -> $sku -> cur_symbol
                ]);
            }
            if (isset($items[$sku]) && $request -> has('action') && $request -> action == 'delete') {
                $curSymbol = $items[$sku]['cur_symbol'];
                unset($items[$sku]);
                if (count($items) == 0) {
                    $data = [
                        'subtotal' => 0,
                        'discount' => 0,
                        'shipping' => 0,
                        'total' => 0,
                        'cur_symbol' => $curSymbol
                    ];
                    Cookie::queue(Cookie::forget('cart'));
                } else {
                    $items = json_encode($items);
                    Cookie::queue('cart', $items, 1440);
                    $items =json_decode($items);
                    $subtotal = $this -> subtotalCounting($items);
                    $checkoutAmount = $this -> itemsCheckoutAmountCounting($items);
                    $discount = $checkoutAmount - $subtotal;
                    $shippingAmount = $this -> getShippingAmount($request -> delivery, $items);
                    $data = [
                        'subtotal' => $subtotal,
                        'discount' => $discount,
                        'shipping' => $shippingAmount,
                        'total' => $shippingAmount + $checkoutAmount,
                        'cur_symbol' => $curSymbol
                    ];
                }
                return $this -> ajaxResponse(true, true, 'success.', $data);
            }
            return $this -> ajaxResponse(false, false, 'Invalid request params.', []);

        } else {
            return $this -> ajaxResponse(false, false, 'Invalid request params.', []);
        }
    }


}
