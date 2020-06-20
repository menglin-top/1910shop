<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function reg(){
        $key="name1";
        $val=Redis::get($key);
        var_dump($val);
        echo "$key:".$val;
    }
}
