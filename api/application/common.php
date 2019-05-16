<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use app\libs\response\SuccessResponse;

// 成功响应方法
function success($data = [], $msg = '', $code = 0, $header = []) 
{
    SuccessResponse::$msg = $msg;
    SuccessResponse::$errCode = $code;
    return SuccessResponse::create($data, 'success', 200, $header); 
}
