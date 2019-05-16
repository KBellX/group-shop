<?php

namespace app\api\validate;

class Address extends BaseValidate
{
    protected $rule = [
        'name' => 'require|max:32',
        'phone' => 'require|mobile',
        'province' => 'require|max:32',
        'city' => 'require|max:32',
        'area' => 'require|max:32',
        'detail' => 'require|max:128',
        'code' => 'require|number'
    ]; 

    protected $scene = [
        'create' => ['name', 'phone', 'province', 'city', 'area', 'code', 'detail'], 
        'update' => ['name', 'phone', 'province', 'city', 'area', 'code', 'detail'], 
    ];
}
