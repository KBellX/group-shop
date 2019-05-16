<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use think\Request;
use app\api\service\Order as OrderService;
use app\api\validate\Order as OrderValidate;
use app\api\model\Order as OrderModel;

class Order extends BaseController
{
    protected $middleware = [ 
        'Auth'  
    ];

    public function save()
    {
        (new OrderValidate())->goCheck();
        $orderService = new OrderService();
        $order = $orderService->add($this->request->userId, $this->request->post());
        return success($order);
    }

    public function read($id)
    {
        $order = OrderModel::getDetail($id);
        if ($order && $order['user_id'] == $this->request->userId) {
            return success($order);
        } else {
            return success([]);
        }
    }

    public function lists()
    {
        $params = $this->request->only(['status']);
        // var_dump($params);die;
        $data = OrderModel::getList($this->request->userId, $params);

        return success($data);
    }

    public function sign($id)
    {
        $orderService = new OrderService();
        $orderService->sign($id, $this->request->userId);
        return success([], '签收成功');
    }
}
