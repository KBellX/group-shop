<?php

namespace app\api\model;

class Goods extends BaseModel
{
    public function GroupGoods()
    {
        return $this->hasOne('GroupGoods', 'goods_id');
    }

    public static function getDetail($id)
    {
        $fields = [];
        $goods = static::where([
            'status' => 1,
            'id' => $id
        ])->with('GroupGoods')
        ->find();

        if ($goods) {
            $goods['express'] = 0;
        }

        $goods = static::dealGroupGoods($goods);

        return $goods;
    }

    public static function dealGroupGoods($goods)
    {
        $groupGoods = $goods['group_goods'];
        $goods['sell_price'] = $groupGoods['group_price'];
        $goods['people_num'] = $groupGoods['people_num'];
        $goods['validity'] = $groupGoods['validity'];
        unset($goods['group_goods']);

        return $goods;
    }

    public function getDetailAttr($value)
    {
        if ($value) {
            $value = json_decode($value, true);
        }
        return $value;
    }
    public function getImgsAttr($value) 
    {
        if ($value) {
            $value = json_decode($value, true);
        }
        return $value;
    }

    public static function getList($pageIdx, $pageSize, $where)
    {
        $fields = ['id', 'name', 'thum', 'market_price', 'sell_price'];
        $where['status'] = 1;
        $num = static::where($where)->count();
        if ($num) {
            $list = static::field($fields)->where($where)->page($pageIdx, $pageSize)->order(['sort' => 'desc', 'id' => 'desc'])->select();
        } else {
            $list = [];
        }

        foreach ($list as &$goods) {
            $goods = static::dealGroupGoods($goods);
        }

        return [
            'total' => $num,
            'list' => $list
        ];
    }

    public static function getFullList($pageIdx, $pageSize, $where)
    {

    }

}
