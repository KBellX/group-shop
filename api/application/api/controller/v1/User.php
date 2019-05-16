<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use think\Request;
use app\api\validate\User as UserValidate;
use app\api\service\User as UserService;
use app\api\model\User as UserModel;
use app\api\validate\Token as TokenValidate;
use app\api\service\TokenFactory;

class User extends BaseController
{
    protected $middleware = [ 
        'Auth'  => ['except' => ['register', 'login', 'refreshToken', 'index']]
    ];

    public function index(Request $res)
    {
        $pageIdx = $res->page ? $res->page : $this->defaultPageIdx;
        $pageSize = $res->limit ? $res->limit : $this->defaultPageSize;
        $conditions = $this->buildConditions(['id', 'username', 'nickname', 'begin_time', 'end_time']);
        $data = UserModel::getList($pageIdx, $pageSize, $conditions);
        return success($data);
    }

    public function register(Request $res)
    {
        (new UserValidate())->goCheck('register');
        $service = new UserService();
        $service->register($res->post('username'), $res->post('password'));

        return success([], '注册成功');
    }

    public function login(Request $res) 
    {
        (new UserValidate())->goCheck('login');
        $service = new UserService();
        $token = $service->login($res->post('username'), $res->post('password'));

        return success($token);
    }

    public function logout()
    {
        return success([]);
    }

    public function update(Request $res)
    {   
        (new UserValidate())->goCheck('update');
        $user = UserModel::where(['id' => $res->userId])->find();
        if (!$user) {
            throw new UserEexception('用户不存在');
        }
        $data = $res->only(['nickname', 'avatar']);
        $user->save($data);
    }

    public function refreshToken(Request $res)
    {
        (new TokenValidate())->goCheck();       
        $tokenService = TokenFactory::instance();
        $tokenData = $tokenService->refresh($res->token, $res->refresh_token);
        return success($tokenData);
    }

    public function read(Request $res)
    {
        $user = UserModel::getUserInfo($res->userId);
        return success($user);
    }
}
