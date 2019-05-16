<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

// Route::get('api/v1/admin/index', 'api/v1.Admin/index');

// Route::get('api/v1/admin/index', 'api/BaseController/index');

// 管理员
Route::group('api/:version/admin', function() {
    Route::get('index','api/:version.Admin/index');
    Route::get('/:id','api/:version.Admin/read');
    Route::post('','api/:version.Admin/save');
    Route::put('/:id','api/:version.Admin/update');
    Route::delete('/:id','api/:version.Admin/delete');
});

// 用户
Route::group('api/:version.user', function() {
    Route::post('register', 'api/:version.User/register');
    Route::post('login', 'api/:version.User/login');
    Route::post('logout', 'api/:version.User/logout');
    Route::put('', 'api/:version.User/update');
    Route::get('', 'api/:version.User/read');
    Route::post('refresh_token', 'api/:version.User/refreshToken');
    Route::get('index', 'api/:version.User/index');
});

// 商品
Route::group('api/:version.goods', function() {
    Route::get('list', 'api/:version.goods/lists');
    Route::get(':id/grouping', 'api/:version.goods/grouping');
    Route::get(':id', 'api/:version.goods/read');
});

// 我的地址
Route::group('api/:version/address', function() {
    Route::get('','api/:version.Address/index');
    Route::get('default','api/:version.Address/getDefaultAddress');
    Route::get('list','api/:version.Address/lists');
    Route::get('/:id','api/:version.Address/read');
    Route::post('','api/:version.Address/save');
    Route::put('/:id','api/:version.Address/update');
    Route::delete('/:id','api/:version.Address/delete');
});

// 订单
Route::group('api/:version.order', function() {
    Route::get('list', 'api/:version.order/lists');
    Route::post('', 'api/:version.order/save');
    Route::put(':id/sign', 'api/:version.order/sign');
    Route::get(':id', 'api/:version.order/read');
});

// 支付
Route::group('api/:version.pay', function() {
    Route::post('by_money', 'api/:version.pay/moneyPay');
});

return [

];
