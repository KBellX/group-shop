<?php

namespace app\api\service;

use app\api\model\Admin as AdminModel;
use app\libs\exception\AdminException;
use app\libs\crypto\Hash;

class Admin
{
    public function add($data)
    {
        $admin = AdminModel::findByUsername($data['username']);
        if ($admin) {
            throw new AdminException('管理员已存在');
        }
        $data['password'] = Hash::generatePassword($data['password']);

        $admin = new AdminModel();
        $admin->save($data);
    }
}
