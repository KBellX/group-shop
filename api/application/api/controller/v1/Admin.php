<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Admin as AdminModel;

use app\libs\exception\BaseException;
use think\Request;
use app\api\validate\Admin as AdminValidate;
use app\api\service\Admin as AdminService;

class Admin extends BaseController
{
    public function index()
    {
        $list = AdminModel::select();
        
        $result = [
            'code' => 0,
            'msg' => '',
            'data' => $list
        ];
        return $result;
    }

    public function read($id)
    {
        $result = [
            'code' => 0,
            'msg' => '',
            'data' => AdminModel::find($id)
        ];
        return $result;

    }

    public function save(Request $res)
    {
        (new AdminValidate())->goCheck('create');
        $data = $res->only(['username', 'password', 'nickname']);
        $service = new AdminService();
        $service->add($data);

        return success([], '新增管理员成功');
    }

    public function update()
    {
        (new AdminValidate())->goCheck('update');
    }
}

