<?php

namespace app\api\behavior;

class CORS
{
    public function appInit()
    {
//        为每个请求都返回这些header
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: x-token, token,Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE');
//        如果是options，直接返回浏览器想要的header，不往下执行，因为没定义对应的options路由，会报错
        if(request()->isOptions()){
            exit();
        }
    }
}
