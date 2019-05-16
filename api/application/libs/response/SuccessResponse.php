<?php

namespace app\libs\response;

use think\response\Json;

/**
 * 自定义响应类
 * 继承Json ，因为这个成功响应类只返回json格式数据
 */
class SuccessResponse extends Json
{
    public static $msg = '';

    public static $errCode = 0;

    // 统一返回格式
    public function data($data)
    {
        $data = [
            'code' => static::$errCode,
            'msg' => static::$msg,
            'data' => $data,
        ];

        return parent::data($data);
    }
}
