<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class TestController extends Controller
{
    public function hello(){
        echo date("y-m-d H:i:s");
    }
    public function redis(){
        $key="name2";
        $val=Redis::get($key);
        var_dump($val);
        echo "$key:".$val;
    }
    public function test1(){
        $data=[
            "name"=>"zhangsan",
            "email"=>"1501113246@qq.com"
        ];
        return $data;
    }
    public function sign(){
        $key="1910";
        $data="haha";
        $sign=md5($data.$key);
        echo "文本:".$data;echo "<br>";
        echo "生成的签名:".$sign;echo "<hr>";
        $url="http://www.1910.com/secret?data=".$data.'&'."sign=".$sign;
//        echo $url;
        $response = file_get_contents($url);
        echo $response;
    }
    public function secret(){
        $key="1910";
        $data=$_GET['data'];
        $sign=$_GET['sign'];
        echo "文本:".$data;echo "<br>";
        echo "生成的签名:".$sign;echo "<hr>";
        $local_sign=md5($data.$key);
        echo "生成的签名:".$local_sign;echo "<hr>";
        if($local_sign==$sign){
            echo "签名通过";
        }else{
            echo "签名失败";
        }
    }
}
