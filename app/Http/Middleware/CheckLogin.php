<?php

namespace App\Http\Middleware;

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
        $is_login = $request->session()->get('user_id');
        if (!$is_login) {
            return redirect('/api/nologin');
        }else{
            return $next($request);
        }
    }
}
