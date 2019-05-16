<?php
namespace app\api\service\token;


use app\libs\exception\TokenException;
use app\libs\exception\UserException;
use app\api\model\UserToken;
use think\facade\Config;

class Db extends Worker
{
    public function get($userId)
    {
        $tokenData = $this->generateToken();
        $userToken = UserToken::where(['user_id' => $userId])->find();

        if (!$userToken) {
            UserToken::create([
                'user_id' => $userId,
                'token' => $tokenData['token'],
                'refresh_token' => $tokenData['refresh_token'],
            ]);
        } else {
            // 已存在token则更新之, 让旧的失效
            $userToken['token'] = $tokenData['token'];
            $userToken['refresh_token'] = $tokenData['refresh_token'];
            $userToken->save();
        }

        return $tokenData;
    }

    public function refresh($token, $refresh_token)
    {
        $expire_in = Config::get('extra.refresh_token_expire_in');

        $t = date('Y-m-d H:i:s', time() - $expire_in);
        $userToken = UserToken::where([
            'token' => $token,
            'refresh_token' => $refresh_token,
        ])->where('update_at', '>=', $t)->find();

        if (!$userToken) {
            throw new TokenException('刷新token无效', 3002);
        }

        $tokenData = $this->generateToken();

        $userToken->token = $tokenData['token'];
        $userToken->refresh_token = $tokenData['refresh_token'];
        $userToken->save();

        return $tokenData;
    }

    public function verify($token)
    {
        $userToken = UserToken::getByToken($token);
        if (!$userToken) {
            throw new TokenException('令牌无效', 3003);
        }

        $expire_in = Config::get('extra.token_expire_in');
        if (strtotime($userToken->update_at) + $expire_in < time()) {
            throw new TokenException('令牌失效过期', 3001);
        }

        return $userToken->user_id;
    }
}

