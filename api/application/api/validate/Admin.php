<?php

namespace app\api\validate;

class Admin extends BaseValidate
{
    protected $rule = [
        'id' => 'require|number',
        'username' => 'require|max:32',
        'password' => 'require',
        'nickname' => 'require|max:32',
    ]; 

    protected $scene = [
        'create' => ['username', 'password', 'nickname'],
        'update' => ['id', 'username', 'password', 'nickname'],
    ];
}
