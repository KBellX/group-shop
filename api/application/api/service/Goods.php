<?php

namespace app\api\service;

use app\libs\exception\UserException;
use app\api\model\OrderGoods as OrderGoodsModel;
use app\libs\enum\OrderStatusEnum;
use app\api\model\User as UserModel;

class Goods
{
    public function getGroupingList($goodsId)
    {
        $list = OrderGoodsModel::field(['order_id'])->where([
            'goods_id' => $goodsId
        ])->with(['Order' => function($query) {
            $query->field(['id', 'p_id', 'user_id', 'status', 'validity', 'create_at']);
        }])->select();
        $validList = [];
        foreach ($list as $goods) {
            $order = $goods['order'];
            if ($order['p_id'] == 0 && $order['status'] == OrderStatusEnum::PAID) {
                // 获取团长信息
                $user = UserModel::field(['avatar', 'nickname'])->where(['id' => $order['user_id']])->find();
                $goods['user'] = $user;
                // 计算有效期
                $lastT = strtotime($order['create_at']) + $order['validity'] * 3600 - time();
                // if ($lastT > 0) {
                    $goods['validity'] = 2;     // 写死 剩余2小时
                    unset($goods['order']);
                    $validList[] = $goods;
                // }
            }
        }
        return $validList;
    }
}
