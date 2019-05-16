<?php

namespace app\api\validate;

class Token extends BaseValidate
{
    protected $rule = [
        'token' => 'require',
        'refresh_token' => 'require',
    ]; 
}
