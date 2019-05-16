<?php
namespace app\api\service\token;

use app\libs\crypto\Hash;

// 三个主体方法，get, refresh, verify,都要判断 保存类型，重复了，应该写成子类了
// 因此，父类应该是抽象类， 不能实例化， 所以要有创造者！
abstract class Worker
{
    // 获取token
    abstract public function get($userId);

    // 刷新token
    abstract public function refresh($token, $refreshToken);

    // 验证token
    abstract public function verify($token);

    protected function generateToken()
    {
        $token = Hash::generateToken('token');
        $refreshToken = Hash::generateToken('refresh_token');

        return [
            'token' => $token,
            'refresh_token' => $refreshToken,
        ];
    }
}

