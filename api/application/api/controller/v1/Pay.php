<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use think\Request;
use app\api\service\Pay as PayService;
use app\api\validate\Pay as PayValidate;

class Pay extends BaseController
{
    protected $middleware = [ 
        'Auth'  
    ];

    public function moneyPay()
    {
        (new PayValidate())->goCheck();
        $payService = new PayService();
        $payService->doMoneyPay($this->request->userId, $this->request->post('order_id'), $this->request->post('pay_password'));

        return success([], '支付成功');
    }
}
