<?php

/*
 * 商品 异常
 * */

namespace app\libs\exception;


class GoodsException extends BaseException
{
    public $code = 5000;

    public $message = 'Goods error';
}
