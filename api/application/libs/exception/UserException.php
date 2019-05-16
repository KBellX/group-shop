<?php

/*
 * 用户 异常
 * */

namespace app\libs\exception;


class UserException extends BaseException
{
    public $code = 3000;

    public $message = 'User error';
}
