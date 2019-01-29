<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckAdmin
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
        
        //提取token对应的role
        $role = User::getRole($token);
        if($role == 2){
            return $next($request);
        }else{
            return redirect('/api/norole');
        }
    }
}
