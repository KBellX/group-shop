<?php

/*
 * 口令 异常
 * */

namespace app\libs\exception;


class TokenException extends BaseException
{
    public $code = 4000;

    public $message = 'Token error';
}
