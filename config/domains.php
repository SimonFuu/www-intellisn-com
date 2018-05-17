<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2018/5/11
 * Time: 3:05 PM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */

return (env('APP_ENV') === 'production' ? [
        'global' => 'www.intellisn.com',
        'china' => 'www.intellisn.cn',
        'backend' => 'backend.intellisn.cn',
    ] : (env('APP_ENV') === 'testing' ? [
        'global' => 'www-itls.simonfo.com',
        'china' => 'www-itls-cn.simonfo.com',
        'backend' => 'www-itls-backend.simonfo.com',
    ] : [
        'global' => 'www.itls.local',
        'china' => 'www.itls-cn.local',
        'backend' => 'www.itls-backend.local',
    ]));
