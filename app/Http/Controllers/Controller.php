<?php

namespace App\Http\Controllers;

use App\Mail\AdminAlertMail;
use App\Mail\OrderPlacedMail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $response = [
        'commonError' => 'There is something wrong, please try again later.',
        'invalidRequest' => 'Invalid request, please try again.'
    ];

    protected $deliveryCountries = [
        "CN" => "China",
        "DE" => "Germany",
        "ES" => "Spain",
        "FR" => "France",
        "GB" => "United Kingdom",
        "HK" => "Hong Kong, China",
        "IT" => "Italy",
        "NL" => "Netherlands",
        "TW" => "Chinese Taiwan",
        "US" => "United States",
    ];
    public function __construct()
    {
        DB::setDefaultConnection('mysql_' . SITE);
    }

    /**
     * ajax 调用通用返回格式
     * @param bool $result
     * @param bool $status
     * @param string $message
     * @param array $data
     * @return array
     */
    public function ajaxResponse($result = true, $status = true, $message = '', $data = [])
    {
        return ['result' => $result, 'status' => $status, 'message' => $message, 'data' => $data];
    }

    /**
     * 邮件订阅保存
     * @param Request $request
     * @return array
     */
    public function storeSubscription(Request $request)
    {
        if ($request -> has('is_ajax') && $request -> is_ajax) {

            $source = SITE == 'global' ? 0 : 1;
            $sql = sprintf(
                'insert into %s (`id`, `email`, `source`) values ("%s", "%s", "%s") ON DUPLICATE KEY UPDATE `source` = %s',
                config('database.connections.mysql_backend.prefix').'subscriptions',
                dk_get_next_id(), $request -> email, $source, $source);

            $result = DB::connection('mysql_backend') -> insert($sql);

            if ($result) {
                // TODO 订阅成功提示
                return ['result' => true, 'status' => true, 'message' => 'Thank you! We\'ve added you to the mailing lists you selected.', 'data' => []];
            } else {
                return ['result' => true, 'status' => false, 'message' => $this -> response['commonError'], 'data' => []];
            }
        } else {
            return ['result' => false, 'status' => false, 'message' => $this -> response['invalidRequest'], 'data' => []];
        }
    }

    /**
     *
     * @param $order
     * @param int $type 0 - 订单支付成功邮件
     */
    protected function sentMail($mail, $type = 0)
    {
        switch ($type) {
            case 1:
                // 发送邮件
                Mail::to($mail -> email) -> queue(new OrderPlacedMail($mail));
                break;
            default:
                // 管理员邮件
                Mail::to('it@intellisn.com') -> queue(new AdminAlertMail($mail));
        }
    }

    protected function getOrderDetail($order)
    {
        // 获取订单列表
        $detail = DB::connection('mysql_backend') -> table('orders_detail')
            -> select('quantity', 'mark')
            -> where('is_delete', 0)
            -> where('o_id', $order -> id)
            -> get();
        if ($detail -> isNotEmpty()) {
            $sku = [];
            $orderDetail = [];
            foreach ($detail as $item) {
                $sku[] = $item -> mark;
                $orderDetail[$item -> mark] = (object) ['quantity' => $item -> quantity];
            }
            $products = DB::connection('mysql_' . $order -> source)
                -> table('products_sku')
                -> select('products.name', 'products_sku.name as sku_name', 'products_sku.mark', 'products_sku.thumb')
                -> leftJoin('products', 'products.id', '=', 'products_sku.p_id')
                -> whereIn('products_sku.mark', $sku)
                -> get();

            if ($products -> isNotEmpty()) {
                foreach ($products as $product) {
                    $orderDetail[$product -> mark] -> product = $product -> name;
                    $orderDetail[$product -> mark] -> sku = $product -> sku_name;
                    $orderDetail[$product -> mark] -> thumb = $product -> thumb;
                }
            } else {
                // TODO 订单异常 商品没有 SKU 信息
                Log::warning('未获取到产品订单包含产品的sku信息，订单ID：' . $order -> id);
                return false;
            }
        } else {
            // TODO 订单异常 未获取到订单详情
            Log::warning('未获取到产品订单详情信息，订单ID：' . $order -> id);
            return false;
        }
        return $orderDetail;
    }
}
