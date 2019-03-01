<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        $is_login = $request->session()->get('user_id');
        if (!$is_login) {
            $arr = [
                'status'  => false,
                'code'    => 204,
                'message' => '用户未登录',
            ];
            echo json_decode(implode($arr));
            return;
        }

    }
}
