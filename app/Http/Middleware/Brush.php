<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Redis;
use Closure;

class Brush
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $result_api=$_SERVER['REQUEST_URI'];
        $url_hash = substr(md5($result_api),5,10);
        $key=$url_hash;
        $totel=Redis::get($key);
        if($totel>10){
            $response=[
                'errno'=>50010,
                'msg'=>'请求操作频繁,请10秒后再试',
            ];
            Redis::expire($key,10);
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die;
        }else{
            Redis::incr($key);
        }

        return $next($request);
    }
}
