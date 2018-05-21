<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2018/5/11
 * Time: 2:31 PM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */

namespace App\Http\Controllers\Globals;


use App\Http\Controllers\Controller;

class GlobalController extends Controller
{
    /**
     * 计算共计价格
     * @param object $items
     * @return float|int
     */
    protected function subtotalCounting($items = [])
    {
        $sum = 0;
        foreach ($items as $item) {
            $sum += $item -> price * $item -> count;
        }
        return $sum;
    }

    /**
     * 计算真实收取价格
     * @param object $items
     * @return float|int
     */
    protected function itemsCheckoutAmountCounting($items = [])
    {
        $sum = 0;
        foreach ($items as $key => $item) {
            $sum += $this -> getItemCheckoutAmount($key, $item -> count);
        }
        return $sum;
    }

    /**
     * 根据SKU及数量获取折扣信息
     * @param string $sku
     * @param int $count
     * @return float|int
     */
    protected function getItemCheckoutAmount($sku = '', $count = 0)
    {
        switch ($count) {
            case 0:
                $amount = 0;
                break;
            case 1:
                $amount = 8900;
                break;
            case 2:
                $amount = 16900;
                break;
            case 3:
                $amount = 24900;
                break;
            case 4:
                $amount = 32900;
                break;
            default:
                $amount = 7900 * $count;
                break;
        }
        return $amount;
    }

    /**
     * 获取运费价格
     * @param string $location
     * @param object $items
     * @return float|int
     */
    protected function getShippingAmount($location = 'US', $items = [])
    {
        $count = 0;
        foreach ($items as $item) {
            $count += $item -> count;
        }
        $location = strtoupper($location);
        switch ($count) {
            case 0:
                $price = 0;
                break;
            case 1:
                $price = $location == 'US' ? 1300 : ($location == 'CN' ? 500 : 2100);
                break;
            case 2:
                $price = $location == 'US' ? 2600 : ($location == 'CN' ? 1000 : 4200);
                break;
            case 3:
                $price = $location == 'US' ? 3900 : ($location == 'CN' ? 1500 : 6300);
                break;
            case 4:
                $price = $location == 'US' ? 5200 : ($location == 'CN' ? 2000 : 8400);
                break;
            default:
                $price = ($location == 'US' ? 1100 : ($location == 'CN' ? 400 : 1800)) * $count;
                break;
        }
        return $price;
    }
}