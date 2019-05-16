<?php

namespace app\api\model;

class User extends BaseModel
{
    // protected $hidden = [];

    public static function findByUsername($username)
    {
        return static::where(['username' => $username])->find();   
    }

    public static function getUserInfo($id) 
    {
        return static::where(['id' => $id])->field([
            'nickname', 'avatar', 'mobile', 'email'])->find();
    }

    public static function getList($pageIdx, $pageSize, $where)
    {
        $fields = ['id', 'username', 'nickname', 'avatar', 'mobile', 'email', 'create_at'];
        $num = static::where($where)->count();
        if ($num) {
            $list = static::field($fields)->where($where)->page($pageIdx, $pageSize)->order(['id' => 'desc'])->select();
        } else {
            $list = [];
        }

        return [
            'total' => $num,
            'list' => $list
        ];
    }

}
