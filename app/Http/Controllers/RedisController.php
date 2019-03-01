<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Curl\Curl;

class RedisController extends Controller
{
    public function setData(){
        $data = '王智慧牛比';
        try {
            //code...
            $res = Redis::set($data,'havethis');
            return $this->success();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getData()
    {
        $data = '王智慧牛比';
        try {
            //code...
            $res = Redis::get($data);
            return $this->success($res);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function test(){
        $curl = new Curl();
        dd($curl);
    }
}
