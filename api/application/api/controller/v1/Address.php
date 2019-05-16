<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Address as AddressModel;
use think\Request;
use app\api\validate\Address as AddressValidate;
use app\api\service\Address as AddressService;

class Address extends BaseController
{
    protected $middleware = [ 
        'Auth'  => ['except' => ['index']]
    ];

    public function lists()
    {
        $data = AddressModel::getListByUserId($this->request->userId);
        return success($data);
    }

    public function read($id)
    {
        $address = AddressModel::findByIdAndUserId($id, $this->request->userId);
        return success($address);
    }

    public function save(Request $res)
    {
        (new AddressValidate())->goCheck('create');
        $data = $res->only(['name', 'phone', 'province', 'city', 'area', 'code', 'detail']);
        $data['user_id'] = $res->userId;
        $service = new AddressService();
        $service->add($data);

        return success([], '添加地址成功');
    }

    public function update($id)
    {
        (new AddressValidate())->goCheck('update');
        $data = $this->request->only(['name', 'phone', 'province', 'city', 'area', 'code', 'detail']);
        $service = new AddressService();
        $service->edit($id, $this->request->userId, $data);

        return success([], '修改地址成功');

    }

    public function delete($id) 
    {
        $address = AddressModel::findByIdAndUserId($id, $this->request->userId);
        if (!$address) {
            throw new UserException('操作异常');
        }

        $address->sDelete();
        return success([]);
    }

    public function getDefaultAddress()
    {
        $data = AddressModel::getListByUserId($this->request->userId);
        if ($data['total'] > 0) {
            $address = $data['list'][0];
        } else {
            $address = null;
        }

        return success($address);
    }
}

