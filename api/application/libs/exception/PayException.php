<?php

/*
 * 支付 异常
 * */

namespace app\libs\exception;


class PayException extends BaseException
{
    public $code = 7000;

    public $message = 'Pay error';
}
