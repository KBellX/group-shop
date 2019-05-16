<?php

/*
 * 用户行为导致异常 基类
 * */

namespace app\libs\Exception;

class BaseException extends \Exception
{
    public function __construct($msg = '', $code = 0)
    {
        if ($msg) {
            $this->message = $msg;
        }

        if ($code) {
            $this->code = $code;
        }
        
    }

}
