<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FileController;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $account = request()->input('account');
        if(!$account){
            return $this->fail(201);
        }
        try {
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
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function login2(Request $request)
    {
        $account = request()->input('account');
        $md5_code = request()->input('md5_vcode');
        if(!$account || !$md5_code){
            return $this->fail(201);
        }
        User::createToken($account,str_random(60));
        $res = User::getUserInfo($account);
        $hash = md5($res->password.$res->vcode);
        if($hash == $md5_code){
            //登录成功
            $res->password = null;
            //  User::changeTime();
            return $this->success($res);
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
        
        try {
            $res = User::addUser($arr);
            return $this->success();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function logout(Request $request)
    {
        $account = request()->input('account');
        if(!$account){
            return $this->fail(201);
        }
        User::createToken($account,'logout');
        return $this->success(200);
    }

    public function nologin()
    {
        return $this->fail(204);
    }

    public function upload(Request $request)
    {
        try {
            $path = $request->file('img')->store('public');
            $real_path = Storage::url($path);
            //$arr['img_url'] = 'https://'.$_SERVER['SERVER_NAME'].'/blog/public'.$real_path;
            $url = 'https://'.$_SERVER['SERVER_NAME'].'/blog/public'.$real_path;
            return $this->successForUpload($url);
        } catch (\Throwable $th) {
            //throw $th;
            return $this_>fail(207);
        }
        
    }

    public function changeUserInfo()
    {
        $name = request()->input('name');
        $id = request()->input('id');
        $user_pic = request()->input('user_pic');
        if(!$user_pic || !$name || !$id){
            return $this->fail(201);
        }
        $arr['name'] = $name;
        $arr['user_pic'] = $user_pic;
        try {
            $res = User::changeUserInfo($id,$arr);
            return $this->success();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function noRole()
    {
        return $this->fail(206);
    }
}