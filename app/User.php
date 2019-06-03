<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

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

    static public function changeTime($token)
    {
        return self::where('api_token',$token)->update(['last_request_time'=>date('Y-m-d H:i:s',time())]);
    }

    static public function getLastTime($token)
    {
        return self::where('api_token',$token)->value('last_request_time');
    }

    static public function getRole($token)
    {
        return self::where('api_token',$token)->value('role');
    }
}