<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * 登录及注册时需要
     */
    static public function checkUser($account=''){
        //通过account进行查询
        return self::where('account',$account)->exists();
    }

    static public function checkToken($token){
        //通过token进行查询
        return self::where('api_token',$token)->exists();
    }

    static public function changeVcode($vcode,$account){
        return self::where('account',$account)->update(['vcode'=>$vcode]);
    }

    static public function getUserInfo($account){
        return self::where('account',$account)->first();
    }

    static public function addUser($info_arr){
        return self::insert($info_arr);
    }

    static public function changeUserInfo($id,$arr)
    {
        return self::where('id',$id)->update($arr);
    }
    
    static public function createToken($account,$api_token)
    {
        return self::where('account',$account)->update(['api_token'=>$api_token]);
    }
}