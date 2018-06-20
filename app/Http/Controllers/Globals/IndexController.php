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


use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IndexController extends GlobalController
{
    public function showIndex()
    {
        return view('global.index', ['productId' => '6402415426629795841']);
    }
    public function setShipmentForm($id = 0)
    {
        DB::setDefaultConnection('mysql_backend');
        $express = DB::table('express_companies')
            -> select('id', 'name', 'website')
            -> where('is_delete', 0)
            -> get();
        $companies = [];
        if ($express -> isNotEmpty()) {
            foreach ($express as $company) {
                $companies[$company -> id] = $company -> name . '@' . $company -> website;
            }
        } else {
            return abort(500, 'Express companies not found');
        }

        $order = DB::table('orders')
            -> select('id', 'address', 'create_at')
            -> where('status', 1)
            -> where('id', $id)
            -> where('is_delete', 0)
            -> first();
        if ($order) {
            return view('backend.orders.shipment.form', ['order' => $order, 'expressCompanies' => $companies]);

        } else {
            return abort(404, 'Order not found');
        }
    }

    public function storeShipmentForm(Request $request)
    {
        $rules = [
            'oId' => 'required',
            'cId' => 'required',
            'number' => 'required'
        ];
        $this -> validate($request, $rules);

        DB::setDefaultConnection('mysql_backend');

        DB::beginTransaction();
        try {
            DB::table('orders')
                -> where('id', $request -> oId)
                -> where('is_delete', 0)
                -> where('status', 1)
                -> update(['status' => 2]);
            DB::table('orders_express')
                -> insert([
                    'o_id' => $request -> oId,
                    'c_id' => $request -> cId,
                    'number' => $request -> number,
                    'admin_id' => Auth::user() ? Auth::user() -> id : '123'
                ]);
            DB::commit();
            //{"recipient": "123", "id": "orderId", "shipment": {"company":"EMS", "website": "http://www.baidu.com", "number": "123456"}}

            $shipment = DB::table('orders_express')
                -> select('orders_express.number', 'express_companies.name as company', 'express_companies.website')
                -> leftJoin('express_companies', 'orders_express.c_id', '=', 'express_companies.id')
                -> where('orders_express.o_id', $request -> oId)
                -> first();
            $order = DB::table('customers')
                -> select('orders.id', 'customers.email', 'customers_address.name as recipient')
                -> leftJoin('customers_address', 'customers_address.c_id', '=', 'customers.id')
                -> leftJoin('orders', 'orders.a_id', '=', 'customers_address.id')
                -> where('orders.id', $request -> oId)
                -> first();
            if ($shipment && $order) {
                $order -> shipment = $shipment;
                $this -> sentMail($order, 2);
                dd('success');
            } else {
                Log::warning(sprintf('无法获取订单【%s】的相关信息，请检查！'));
                return abort(500);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::warning('保存订单发货信息失败：' . $e -> getMessage());
            return abort(500);
        }
    }

}