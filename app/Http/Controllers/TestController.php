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
        echo 123;
    }
}
