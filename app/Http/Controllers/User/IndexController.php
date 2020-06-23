<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Model\User;

class IndexController extends Controller
{
    public function reg(){
        return view("user/reg");
    }
    public function do_reg(){
        $user_name=request()->post("user_name");
        $user_name=User::where("user_name",$user_name)->first();
        if($user_name){
            die("用户名已存在");
        }

        $email=request()->post("email");
        $email=User::where("email",$email)->first();
        if($email){
            die("邮箱已存在");
        }

        $password1=request()->post("password1");
        $password=request()->post("password");
        if($password1!=$password){
            die("密码输入错误,请重新输入");
        }

        $data=request()->except('_token');
        $data['password']=password_hash($password,PASSWORD_DEFAULT);
        $user=User::create($data);
        if($user){
            return redirect('user/login');
        }
    }
    public function login(){
        return view("user/login");
    }
    public function do_login(){
        $user_name=request()->post("user_name");
        $password=request()->post("password");
        $user=User::where(["user_name"=>$user_name])->first();
        $res=password_verify($password,$user->password);
        if($res){
//            setcookie("user_id",$user->user_id,time()+3600,"/");
//            setcookie("user_name",$user->user_name,time()+3600,"/");
            Cookie::queue('user_id',$user->user_id,10);
            Cookie::queue('user_name',$user->user_name,10);
            header("Refresh:1;url=/user/conter");
            echo "登陆成功";
        }else{
            header("Refresh:1;url=/user/login");
            echo "登陆失败";
        }
    }
    public function conter(){
        if(Cookie::has('user_id')){
            $user=User::limit(5)->get();
            return view("user/conter",compact("user"));
        }else{
            return redirect("user/login");
        }
//        if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_name'])){
//            $user=User::limit(5)->get();
//            return view("user/conter",compact("user"));
//        }else{
//            return redirect("user/login");
//        }
    }
}
