<?php

namespace app\api\service;

use app\api\model\User as UserModel;
use app\libs\exception\UserException;
use app\libs\crypto\Hash;
use app\api\service\TokenFactory;

class User
{
    public function register($username, $password)
    {
        $user = UserModel::findByUsername($username);
        if ($user) {
            throw new UserException('用户名已被注册');
        }
        $data['password'] = Hash::generatePassword($password);
        $data['username'] = $username;
        $user = new UserModel();
        // 如果不成功会抛异常，如果要用事务保证原子性，就要捕获异常
        $user->save($data);
    }

    public function login($username, $password)
    {
        $user = UserModel::findByUsername($username);
        if (!$user) {
            throw new UserException('用户名或密码错误');
        }
        if (!Hash::verifyPassword($password, $user['password'])) {
            throw new UserException('用户名或密码错误');
        }

        $tokenService = TokenFactory::instance();
        $tokenData = $tokenService->get($user['id']);

        return $tokenData;
        
    }
}
