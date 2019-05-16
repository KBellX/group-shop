<?php

namespace app\http\middleware;

use app\libs\exception\TokenException;
use app\api\service\TokenFactory;

/**
 * 用户身份认证中间件
 */

class Auth
{
    public function handle($request, \Closure $next)
    {
        $token = $request->header('token');

        if ($token === null) {
            throw new TokenException('令牌缺失');
        }
        $tokenService = TokenFactory::instance();
        $request->userId = $tokenService->verify($token);
        // 传才验证的中间件另写一个类, 若有需要

        return $next($request);
    }
}

