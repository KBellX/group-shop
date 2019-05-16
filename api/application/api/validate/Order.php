<?php

namespace app\api\validate;

class Order extends BaseValidate
{
    protected $rule = [
        'goods_list' => 'require|array',
        'p_id' => 'require|number',
        'address_id' => 'require|number',
        'remark' => 'max:256',
    ]; 
}
