<?php

/*
 * 订单 异常
 * */

namespace app\libs\exception;


class OrderException extends BaseException
{
    public $code = 6000;

    public $message = 'Order error';
}
