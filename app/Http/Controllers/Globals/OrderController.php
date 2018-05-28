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
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends GlobalController
{
    public function create(Request $request)
    {
        if (
            $request -> ajax() &&
            $request -> has('delivery') &&
            $request -> has('data') &&
            $request -> data &&
            is_array($request -> data) &&
            isset($this -> deliveryCountries[$request -> delivery])
        ) {
            $cartRecords = json_decode(Cookie::get('cart'), true);
            foreach ($request -> data as $data) {
                // 校验 data 体内的参数是否合规
                if (!isset($cartRecords[$data['sku']]) || !isset($data['sku']) || !isset($data['count'])) {
                    return $this -> ajaxResponse(true, false, '请求参数不合法', []);
                }
                $sku[] = $data['sku'];
                $itemsCount[$data['sku']] = $data['count'];
            }

            // 比较请求体包含的产品条目数量与购物车的产品条目是否一直
            $count = count($cartRecords);
            if (count($sku) !== $count) {
                return $this -> ajaxResponse(true, false, '请求参数不合法', []);
            }

            // 获取价格
            $products = DB::table('products_sku')
                -> select('p_id', 'sku', 'price', 'currency', 'cur_symbol')
                -> where('is_delete', 0) -> whereIn('sku', $sku) -> get();


            if ($products -> isNotEmpty() && count($products) === $count) {
                // 数据库中包含相应的产品，且数量一直，校验完成
                $currency = 'USD';  // 定义货币
                $curSymbol = '$';   // 定义货币符号
                $orderDetail = [];  // 定义 order_detail 需要的数据
                $ids = dk_get_next_ids($count + 1);  // 生成 snowflake ID （数量是产品条目 + 1）
                $orderId = $ids['0'];       // 定义 订单ID
                $orderItemsCount = 0;       // 定义订单包含产品数量
                $items = [];                // 定义计算 价格时候，所需要的 items

                foreach ($products as $key => $product) {
                    $orderDetail[] = [
                        'id' => $ids[$key + 1],
                        'o_id' => $orderId,
                        'sku' => $product -> sku,
                        'quantity' => $itemsCount[$product -> sku]
                    ];

                    $items[$product -> sku] = [
                        'count' => $itemsCount[$product -> sku],
                        'price' => $product -> price,
                    ];

                    $orderItemsCount += $itemsCount[$product -> sku];
                    $currency = $product -> currency;
                    $curSymbol = $product -> cur_symbol;
                }
                $items = json_decode(json_encode($items));
                $subtotal = $this -> subtotalCounting($items);
                $checkoutAmount = $this -> itemsCheckoutAmountCounting($items);
                $discount = $subtotal - $checkoutAmount;
                $shippingAmount = $this -> getShippingAmount($request -> delivery, $items);
                $total = $shippingAmount + $checkoutAmount;
                $order = [
                    'id' => $orderId,
                    'car' => $request -> delivery,
                    'remark' => sprintf('来自【%s】的订单：订购条目：%s，产品数量：%s，产品金额：%s，折扣：%s，运费金额：%s，总计应支付金额：%s',
                        SITE, count($orderDetail), $orderItemsCount, $subtotal, $discount, $shippingAmount, $total),
                    'quantity' => $orderItemsCount,
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'shipping' => $shippingAmount,
                    'total' => $total,
                    'status' => 0,
                    'source' => SITE,
                    'currency' => $currency,
                    'cur_symbol' => $curSymbol
                ];
                try {
                    DB::setDefaultConnection('mysql_backend');
                    DB::beginTransaction();
                    DB::table('orders_detail') -> insert($orderDetail);
                    DB::table('orders') -> insert($order);
                    DB::commit();
                    Cookie::queue(Cookie::forget('cart'));
                    return $this -> ajaxResponse(true, true, 'success.',
                        ['url' => route(SITE . 'CheckoutForm', ['id' => $orderId])]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::warning('写入数据库错误 - ' . $e -> getMessage());
                    return $this -> ajaxResponse(true, false, '创建订单失败', []);
                }
            } else {
                // 校验失败，找不到对应的SKU，或条目不符(产品下架)，返回错误
                return $this -> ajaxResponse(true, false, '部分产品已下架，请重新添加购物车', []);
            }
        } else {
            return $this -> ajaxResponse(false, false, '非法请求', []);
        }
    }

    public function showCheckoutForm($id = 0)
    {
        $order = DB::connection('mysql_backend') -> table('orders')
            -> select('cur_symbol', 'car', 'total', 'id')
            -> where('status', 0)
            -> where('is_delete', 0)
            -> where('id', $id)
            -> first();
        if (is_null($order)) {
            return abort(404);
        }


        $now = date('Y');
        $years = [];
        for($i = 0; $i < 10; $i++) {
            $years[$now + $i] = $now + $i;
        }
        $months = [
            '01' => '01 - January',
            '02' => '02 - February',
            '03' => '03 - March',
            '04' => '04 - April',
            '05' => '05 - May',
            '06' => '06 - June',
            '07' => '07 - July',
            '08' => '08 - August',
            '09' => '09 - September',
            '10' => '10 - October',
            '11' => '11 - November',
            '12' => '12 - December',
        ];
        return view('global.payment.checkout', [
            'order' => $order,
            'delivery' => [$order -> car => $this -> deliveryCountries[$order -> car]],
            'ccExpYears' => $years,
            'ccExpMonths' => $months,
            'orderId' => $id
        ]);
    }

    public function showReCheckoutForm($id = 0)
    {
        $order = DB::connection('mysql_backend') -> table('orders')
            -> select('cur_symbol', 'car', 'total', 'id')
            -> where('status', 0)
            -> where('is_delete', 0)
            -> whereNotNull('a_id')
            -> where('id', $id)
            -> first();
        if (is_null($order)) {
            return abort(404);
        }


        $now = date('Y');
        $years = [];
        for($i = 0; $i < 10; $i++) {
            $years[$now + $i] = $now + $i;
        }
        $months = [
            '01' => '01 - January',
            '02' => '02 - February',
            '03' => '03 - March',
            '04' => '04 - April',
            '05' => '05 - May',
            '06' => '06 - June',
            '07' => '07 - July',
            '08' => '08 - August',
            '09' => '09 - September',
            '10' => '10 - October',
            '11' => '11 - November',
            '12' => '12 - December',
        ];
        return view('global.payment.recheckout', [
            'ccExpYears' => $years,
            'ccExpMonths' => $months,
            'orderId' => $id,
            'order' => $order
        ]);
    }
    public function showInquiryForm(Request $request)
    {
        if ($request -> has('email') && $request -> has('order_number')) {
            // 获取订单
            $order = DB::connection('mysql_backend') -> table('customers')
                -> select(
                    'orders.id', 'customers.email', 'orders.a_id', 'orders.subtotal', 'orders.discount',
                    'orders.shipping', 'orders.total', 'orders.address', 'orders.cur_symbol', 'orders.status',
                    'customers_address.name as recipient', 'orders.create_at', 'orders.source')
                -> leftJoin('customers_address', 'customers_address.c_id', '=', 'customers.id')
                -> leftJoin('orders', 'orders.a_id', '=', 'customers_address.id')
                -> where('customers.email', $request -> email)
                -> where('orders.id', $request -> order_number)
                -> where('customers.is_delete', 0)
                -> where('orders.is_delete', 0)
                -> first();
            if (is_null($order)) {
                return view('global.orders.inquiry', ['result' => false, 'message' => '订单信息不存在，请重试！']);

            } else {
                $order -> express = DB::connection('mysql_backend')
                    -> table('orders_express')
                    -> select('orders_express.number', 'orders_express.update_at', 'express_companies.name', 'express_companies.website')
                    -> leftJoin('express_companies', 'express_companies.id', '=', 'orders_express.company')
                    -> where('orders_express.o_id', $order -> id)
                    -> where('orders_express.is_delete', 0)
                    -> first();

                $detail = $this -> getOrderDetail($order);
                if ($detail) {
                    $order -> detail = $detail;
                    return view('global.orders.detail', ['order' => $order, 'result' => true]);
                } else {
                    return view('global.orders.inquiry', ['result' => false, 'message' => '订单信息异常，请发送邮件到service@intellisn.com，提供您的订单编号以便查询。']);

                }
            }
        } else {
            return view('global.orders.inquiry');
        }
    }
}