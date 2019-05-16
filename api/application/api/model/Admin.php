<?php

namespace app\api\model;

class Admin extends BaseModel
{
    // protected $hidden = [];

    public static function findByUsername($username)
    {
        return static::where(['username' => $username])->find();   
    }

}
