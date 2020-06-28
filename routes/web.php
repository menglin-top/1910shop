<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/info', function () {
    phpinfo();
});

//没有灵魂
Route::get("/test/hello","TestController@hello");
Route::any("/test/redis","TestController@redis");
Route::any("/test1","TestController@test1");

Route::any("/goods/detail","Goods\GoodsController@detail");//商品信息

Route::get("/user/login","User\IndexController@login");//用户登陆
Route::post("/user/do_login","User\IndexController@do_login");//用户登陆
Route::get("/user/reg","User\IndexController@reg");//用户注册
Route::post("/user/do_reg","User\IndexController@do_reg");//用户注册

Route::any("/user/conter","User\IndexController@conter");//用户中心

//api接口
Route::post("/api/user/reg","Api\UserController@reg");//用户注册
Route::post("/api/user/login","Api\UserController@login");//用户登陆
Route::post("/api/user/conter","Api\UserController@conter")->middleware("check.pri");//个人中心
Route::post("/api/user/orders","Api\UserController@orders")->middleware("check.pri");//我的订单
Route::post("/api/user/cart","Api\UserController@cart")->middleware("check.pri");//购物车



