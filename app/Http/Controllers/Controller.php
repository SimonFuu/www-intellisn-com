<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        DB::setDefaultConnection('mysql_' . SITE);
    }

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
                return ['result' => true, 'status' => true, 'message' => '订阅成功', 'data' => []];
            } else {
                return ['result' => true, 'status' => false, 'message' => '订阅失败', 'data' => []];
            }
        } else {
            return ['result' => false, 'status' => false, 'message' => 'Invalid request.', 'data' => []];
        }
    }
}
