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
        $url="http://www.api.com/secret?data=".$data.'&'."sign=".$sign;
//        echo $url;
       $response = file_get_contents($url);
       echo $response;
    }
    public function sendData(){
        $url="http://www.api.com/test/receive?name=吴孟林&&age=18";
        $response=file_get_contents($url);
        echo $response;
    }
    public function sendPost(){
        $key="wechat";
        $data=[
            'name'=>"lisi",
            'age'=>"18"
        ];
        $str=json_encode($data).$key;
        echo "需要传输过去的数据:";echo $str;echo "<br>";
        $sign=sha1($str);
        $send_data = [
            'data'  => json_encode($data),
            'sign'  => $sign
        ];
        $url="http://www.api.com/test/receive-post";
        //使用 curl post数据
        // 1 实例化
        $ch = curl_init();
        // 2 配置参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);        // 使用post 方式
        curl_setopt($ch,CURLOPT_POSTFIELDS,$send_data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);   // 通过变量接收响应

        // 3 开启会话（发送请求）
        $response = curl_exec($ch);
        // 4 检测错误
        $errno = curl_errno($ch);       //错误码
        $errmsg = curl_error($ch);
        if($errno)
        {
            echo '错误码： '.$errno;echo '</br>';
            var_dump($errmsg);
            die;
        }
        curl_close($ch);
        echo $response;
    }
    public function encrypt(){
        $data="把思念装进漂流瓶";
        echo "原内容:".$data;echo "<br>";
        $method="AES-256-CBC";
        $key="1910";
        $iv="ruguoyunchengshi";
        //加密
        $enc=openssl_encrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);
        echo "对称加密后:".$enc;echo "<br>";echo "<hr>";

        //签名
        $sign=sha1($enc.$key);
        $data_post=[
            'data'=>$enc,
            'sign'=>$sign
        ];
        //解密
//        $dec=openssl_decrypt($enc,$method,$key,OPENSSL_RAW_DATA,$iv);
//        echo "解密后:".$dec;echo "<br>";
        $url="http://www.api.com/test/decrypt";
        //使用 curl post数据
        // 1 实例化
        $ch = curl_init();
        // 2 配置参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);        // 使用post 方式
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data_post);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);   // 通过变量接收响应

        // 3 开启会话（发送请求）
        $response = curl_exec($ch);
        echo $response;
        // 4 检测错误
        $errno = curl_errno($ch);       //错误码
        $errmsg = curl_error($ch);
        if($errno)
        {
            echo '错误码： '.$errno;echo '</br>';
            var_dump($errmsg);
            die;
        }
        curl_close($ch);
    }
}
