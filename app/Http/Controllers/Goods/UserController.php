<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function reg(){
        $name1="zhangsan";
        $val=Redis::get($name1);echo "$val:".$val;
        var_dump($val);

    }
}
