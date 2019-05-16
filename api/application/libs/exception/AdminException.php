<?php

/*
 * 管理员 异常
 * */

namespace app\libs\exception;


class AdminException extends BaseException
{
    public $code = 2000;

    public $message = 'System error';
}
