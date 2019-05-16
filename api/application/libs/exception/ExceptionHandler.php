<?php

namespace app\libs\exception;

use Exception;
use think\exception\Handle;
use think\facade\Config;
use think\facade\Log;

class ExceptionHandler extends Handle
{
    public function render(Exception $e)
    {
        $code = $e->getCode();
        $msg = $e->getMessage();

        if ($e instanceof BaseException) {
            // 用户行为导致错误，返回具体原因
        } else {
            // 系统错误
            if (Config::get('app_debug')) {
                // 开发模式：直接显示，
                return parent::render($e);
            } else {
                // 生成环境，记录日志，返回服务器错误
                $code = 999;
                $msg = 'Server error';

                $this->recordLog($code, $msg);
            }

        }

        $result = [
            'code' => $code,
            'data' => [],
            'msg' => $msg
        ];

        return json($result);
    }

    private function recordLog($code, $msg)
    {
        // 不能关闭异常的error日志写入，待版本更新...
        /*
        $log = Log::init([
            'type' => 'File',
            'level' => ['error'],
            'close' => false
        ]);
        $log->error($code . '|' . $msg);
         */
        // Log::error($code . '|' . $msg);

    }
}
