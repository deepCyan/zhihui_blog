<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckLogin
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
        $token = $request->input('api_token');
        if($token == null){
            return redirect('/api/nologin');
        }
        //判断token是否存在
        $is_have_token = User::checkToken($token);

        if($is_have_token){
            /*//得到上一次访问时间
            $last_request_time = User::getLastTime($token);
            //超过半小时 视为过期
            if(time() - strtotime($last_request_time) > 1800){
                return redirect('/api/timeout');
            }
            //更改本次时间
            User::changeTime($token);*/
            return $next($request);
        }else{
            return redirect('/api/nologin');
        }
    }
}
