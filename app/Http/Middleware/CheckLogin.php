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
        $is_login = User::checkToken($token);
        dd($is_login);
        if (!$is_login) {
            return redirect('/api/nologin');
        }else{
            return $next($request);
        }
    }
}
