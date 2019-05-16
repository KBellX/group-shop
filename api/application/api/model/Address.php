<?php

namespace app\api\model;

class Address extends BaseModel
{
    public static function findByIdAndUserId($id, $userId)
    {
        return static::where([
            'id' => $id,
            'user_id' => $userId,
        ])->find();
    }

    public static function getListByUserId($userId)
    {
        $where = [
            'user_id' => $userId,
        ];
        $num = static::where($where)->count();
        if ($num) {
            $list = static::where($where)->order(['is_default' => 'desc', 'id' => 'desc'])->select();
        } else {
            $list = []; 
        }   

        return [
            'total' => $num,
            'list' => $list
        ];
    }
}
