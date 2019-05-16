<?php

namespace app\api\model;

class OrderGoods extends BaseModel
{
    public function Order()
    {
        return $this->belongsTo('Order', 'order_id');
    } 
}
