<?php

namespace app\api\model;

use app\libs\enum\OrderStatusEnum;

class Order extends BaseModel
{
    // 获取等待人数
    public static function getGroupingNum($pId)
    {
        return static::where([
            'p_id' => $pId,
            'status' => OrderStatusEnum::PAID
        ])->whereOr(['id' => $pId])->count();
    }

    // 批量修改订单状态
    public static function updateStatus($pId, $status)
    {
        return static::where(['p_id' => $pId])->whereOr(['id' => $pId])->update(['status' => $status]);
    }

    public static function getDetail($id)
    {
        return static::where(['id' => $id])->with('OrderGoods')->find();
    }

    public static function getList($userId, $conditions)
    {
        $conditions['user_id'] = $userId;
        return static::where($conditions)->with('OrderGoods')->select();
    }

    public function OrderGoods()
    {
        return $this->hasMany('OrderGoods', 'order_id');
    }
}
