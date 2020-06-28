<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    public function a(){
        $result_api=$_SERVER['REQUEST_URI'];
        $url_hash = substr(md5($result_api),5,10);
        $key=$url_hash;
        $totel=Redis::get($key);
        if($totel>10){
            echo "请求过于频繁";
            Redis::expire($key,10);
        }else{
            $totel=Redis::incr($key);
            echo "totel:"."$totel";
        }
    }
}
