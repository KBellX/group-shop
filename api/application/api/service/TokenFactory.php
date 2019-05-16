<?php

namespace app\api\service;

use think\Exception;
use think\facade\Config;
use app\api\service\token\Cache;
use app\api\service\token\Db;

/**
 * token工厂类
 */

class TokenFactory
{
    public static function instance()
    {
        $keepType = Config::get('extra.token_keep_type');
        switch ($keepType) {
            case 'cache':
                return new Cache();
                break;
            case 'db':
                return new Db();
                break;
            default:
                throw new Exception($keepType . '的token保存方式不存在');
        }
    }
}

