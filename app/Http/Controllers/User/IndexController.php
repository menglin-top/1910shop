<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;

class IndexController extends Controller
{
    public function reg(){
        return view("user/reg");
    }
    public function do_reg(){
        $data=request()->except('_token');
        $user=User::create($data);
        if($user){
            return redirect('user/login');
        }
    }
    public function login(){
        return view("user/login");
    }
    public function do_login(){
        $user=request()->except('_token');
        $user['password']=$user['password'];
        $login=User::where($user)->first();
        if($login){
            return redirect("https://www.baidu.com/");
        }else{
            return redirect("user/login");
        }
    }
}
