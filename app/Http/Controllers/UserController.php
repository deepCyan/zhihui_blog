<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $account = request()->input('account');
        if(!$account){
            return $this->fail(201);
        }
        $res = User::checkUser($account);
        if($res){
            $vcode = rand(0000000,9999999);
            User::changeVcode($vcode,$account);
            $arr['vcode'] = $vcode;
            $arr['acctount'] = $account;
            return $this->success($arr);
        }else{
            return $this->fail(202);
        }
    }

    public function login2(Request $request)
    {
        $account = request()->input('account');
        $md5_code = request()->input('md5_vcode');
        $res = User::getUserInfo($account);
        $hash = md5($res[0]->password.$res[0]->vcode);
        if($hash == $md5_code){
            //登录成功
            session(['user_id'=>$res->id]);
            return $this->success(['account'=>$account,'id'=>$res->id,'msg'=>'登录成功']);
        }else{
            //登录失败
            return $this->fail(203);
        }
    }

    public function res()
    {
        $account = request()->input('account');
        $name = request()->input('name');
        $password = request()->input('password');
        if(!$account || !$name || !$password){
            return $this->fail(201);
        }
        $res = User::checkUser($account);
        if($res){
            return $this->fail(205);
        }
        $arr['account'] = $account;
        $arr['name'] = $name;
        $arr['password'] = $password;
        $res = User::addUser($arr);
        if($res){
            return $this->success(200);
        }else{
            return $this->fail(300);
        }
    }

    public function logout(Request $request)
    {
        try {
            //code...
            $request->session()->forget('user_id');
        } catch (\Throwable $th) {
            //throw $th;

        }
        return $this->success(200);
    }

    public function nologin()
    {
        return $this->fail(204);
    }

    public function upload(Request $request)
    {
        $path = $request->file('user_pic')->store('public');
        $real_path = Storage::url($path);
        $arr['user_pic'] = 'http://'.$_SERVER['SERVER_NAME'].'/blog/public'.$real_path;
        return $this->success($arr);
    }

    public function changeUserInfo(Type $var = null)
    {
        
    }
}