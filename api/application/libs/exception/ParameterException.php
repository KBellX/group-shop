<?php

namespace app\libs\exception;

class ParameterException extends BaseException
{
    public $code = 1000;

    public $message = 'Param error';
}
