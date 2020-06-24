<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Token;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{

    public function reg(Request $request)
    {
        $user_name = request()->input("user_name");
        $user_name = User::where("user_name", $user_name)->first();
        if ($user_name) {
            $response = [
                'errno'  => 50001,
                'msg'    => '用户名已存在'
            ];
            return $response;
        }

        $email = request()->input("email");
        $email = User::where("email", $email)->first();
        if ($email) {
            $response = [
                'errno'  => 50002,
                'msg'    => '邮箱已存在'
            ];
            return $response;
        }

        $password1 = request()->input("password1");
        $password = request()->input("password");
        if ($password1 != $password) {
            $response = [
                'errno'  => 50003,
                'msg'    => '密码输入错误,请重新输入'
            ];
            return $response;
        }

        $data = request()->except('_token');
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        $user = User::create($data);
        if ($user) {
            $response = [
                'errno'  => 0,
                'msg'    => '注册成功'
            ];
        }else{
            $response = [
                'errno'  => 50005,
                'msg'    => '注册失败'
            ];
        }
        return $response;
    }
    public function login(){
        $user_name=request()->input("user_name");
        $password=request()->input("password");
        $user=User::where(["user_name"=>$user_name])->first();
        $res=password_verify($password,$user->password);
        if($res){
            //生成token
            $str=$user->user_id.$user->user_name.time();
            $token = substr(md5($str),10,16) . substr(md5($str),0,10);
//            $data=[
//                'uid'   => $user->user_id,
//                'token' => $token
//            ];
//            Token::insert($data);
            Redis::set($token,$user->user_id);
            Redis::expire($token,90);
            $response = [
                'errno'  => 0,
                'msg'    => '登陆成功',
                'token'=>$token
            ];
        }else{
            $response = [
                'errno'  => 40001,
                'msg'    => '用户名密码不一致'
            ];
        }
        return $response;
    }
    public function conter(){
        $token=$_GET["token"];
        //$res=Token::where("token",$token)->first();
        $uid=Redis::get($token);
        if($uid){
            //$uid = $res->uid;
            $user_info = User::find($uid);
            echo $user_info->user_name."欢迎来到个人中心";
        }else{
            echo "请先登陆";
        }
    }
}
