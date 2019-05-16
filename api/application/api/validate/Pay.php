<?php

namespace app\api\validate;

class Pay extends BaseValidate
{
    protected $rule = [
        'order_id' => 'require|number',
        'pay_password' => 'require',
    ]; 
}
