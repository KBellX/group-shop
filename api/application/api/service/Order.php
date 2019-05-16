<?php

namespace app\api\service;

use think\Db;
use app\api\model\Order as OrderModel;
use app\libs\exception\OrderException;
use app\api\model\Address as AddressModel;
use app\libs\crypto\Hash;
use app\api\model\Goods as GoodsModel;
use app\api\model\OrderGoods as OrderGoodsModel;
use app\libs\enum\OrderStatusEnum;

class Order
{
    public function sign($id, $userId)
    {
        $order = OrderModel::where([
            'id' => $id,
            'user_id' => $userId
        ])->find();
        if (!$order) {
            throw new OrderException('订单不存在');
        }
        if ($order['status'] != OrderStatusEnum::DELIVERED) {
            throw new OrderException('订单状态异常，不可签收');
        }
        $order->status = OrderStatusEnum::FINISHED;
        $order->save();
    }

    public function checkPOrder($pId)
    {
        $pOrder = OrderModel::where([
            'id' => $pId,
        ])->find();
        if (!$pOrder) {
            throw new OrderException('团不存在');
        }
        // 校验状态
        if ($pOrder['status'] != OrderStatusEnum::PAID) {
            throw new OrderException('团不处于拼团状态');           
        }

        // 校验时间
        if (time() - strtotime($pOrder['create_at']) > $pOrder['validity'] * 3600  ) {
            // 改所有订单状态
            OrderModel::updateStatus($pId, OrderStatusEnum::GROUP_FAIL);
            throw new OrderException('该团已超时，遗憾~');
        }

        return $pOrder;
    }

    public function add($userId, $data)
    {
        $orderData = [
            'freight' => 0,
            'remark' => $data['remark'],
            'p_id' => $data['p_id'],
            'user_id' => $userId,
            'status' => 0
        ];

        if ($data['p_id'] != 0) {
            // 入团处理
            $pOrder = $this->checkPOrder($data['p_id']);
            // 不能加自己创的团
            if ($pOrder['user_id'] == $userId) {
                throw new OrderException('不能加入自己创建的团');
            }
        }
        // var_dump($data);

        // 地址
        $address = AddressModel::findByIdAndUserId($data['address_id'], $userId);
        if (!$address) {
            throw new OrderException('地址不存在');
        }
        $orderData['consignee'] = $address['name'];
        $orderData['phone'] = $address['phone'];
        $orderData['a_code'] = $address['a_code'];
        $orderData['address'] = $address['province'] . $address['city'] . $address['area'] . $address['detail'];

        // 生成订单号
        $orderData['order_no'] = $this->generateOrderNo();
        $orderData['goods_str'] = json_encode($data['goods_list']);

        // 获取商品信息
        $goodsList = $data['goods_list'];
        $orderGoodsData = $this->prepareOrderGoods($goodsList);

        $price = $this->calcPrice($orderGoodsData);
        $orderData = array_merge($orderData, $price);

        $orderData['people_num'] = $orderGoodsData[0]['people_num'];
        if ($data['p_id'] == 0) {
            $orderData['validity'] = $orderGoodsData[0]['validity'];
        }

        // var_dump($orderData);
        Db::startTrans();
        try{
            $order = new OrderModel();       
            $order->save($orderData);
            foreach ($orderGoodsData as $goods) {
                // 写入订单商品表
                $orderGoods = new OrderGoodsModel();
                $goods['order_id'] = $order['id'];
                unset($goods['people_num'], $goods['validity']);
                $orderGoods->save($goods);
            }
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            throw new OrderException('创建订单失败');
        }

        return $order;
    }

    private function prepareOrderGoods($goodsList)
    {
        $orderGoodsArr = [];
        foreach ($goodsList as $g) {
            $goods = GoodsModel::getDetail($g['id']);
            $orderGoods = [
                'goods_id' => $goods['id'],
                'sell_price' => $goods['market_price'],
                'real_price' => $goods['sell_price'],
                'thum' => $goods['thum'],
                'goods_name' => $goods['name'],
                'num' => $g['num'],
                'status' => 0,
                'people_num' => $goods['people_num'],
                'validity' => $goods['validity']
            ];

            $orderGoodsArr[] = $orderGoods;
        }

        return $orderGoodsArr;
    }

    private function calcPrice($goodsList)
    {
        $goodsPrice = 0;
        $realPrice = 0;

        foreach ($goodsList as $goods) {
            $goodsPrice += $goods['sell_price'] * $goods['num'];
            $realPrice += $goods['real_price'] * $goods['num'];
        }

        return [
            'goods_price' => $goodsPrice,
            'real_price' => $realPrice,
            'reduce_price' => $goodsPrice - $realPrice,
        ];

    }

    private function generateOrderNo()
    {
        $orderNo = 'N' . time() .  Hash::getRandChar(16);
        return $orderNo;
    }
}
