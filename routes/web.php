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

Route::any("/goods/detail","Goods\GoodsController@detail");//商品信息
Route::any("/goods/info","Goods\GoodsController@info");//               没有东西
Route::any("/user/reg","Goods\UserController@reg");//用户注册

