<?php

namespace app\api\service;

use app\api\model\Order as OrderModel;
use app\libs\exception\PayException;
use app\libs\exception\OrderException;
use app\libs\enum\OrderStatusEnum;
use app\api\service\Order as OrderService;

class Pay
{
    public function doMoneyPay($userId, $orderId, $payPassword)
    {
        // 校验订单与用户
        $order = OrderModel::where([
            'id' => $orderId,
            'user_id' => $userId,
        ])->find();
        if (!$order) {
            throw new PayException('订单不存在');
        }
        if ($order['status'] != OrderStatusEnum::UNPAID) {
            throw new PayException('订单状态异常');
        }
        // 校验密码
        if ($payPassword != '123456') {
            throw new PayException('支付密码错误');
        }

        // 改订单状态
        if ($order['p_id'] != 0) {
            $orderService = new OrderService();
            $pOrder = $orderService->checkPOrder($order['p_id']);

            $groupNum = OrderModel::getGroupingNum($order['p_id']);
            if ($groupNum + 1 == $pOrder['people_num']) {
                OrderModel::updateStatus($order['p_id'], OrderStatusEnum::GROUP_SUCCESS);               
                return true;
            } 
        }
        $order->status = OrderStatusEnum::PAID;
        $order->save();
        return true;

        // 扣除余额
    }
}
