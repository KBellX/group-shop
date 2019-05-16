<?php

namespace app\api\validate;

class User extends BaseValidate
{
    protected $rule = [
        'username' => 'require|max:32',
        'password' => 'require',
        // 'id' => 'require|number',
        'nickname' => 'max:32',
        'avatar' => 'max:256',
        'phone' => 'mobile',
        'email' => 'email',
    ]; 

    protected $scene = [
        'register' => ['username', 'password'],
        'login' => ['username', 'password'],
        'update' => ['nickname', 'avatar', 'phone', 'email'],
    ];

}
