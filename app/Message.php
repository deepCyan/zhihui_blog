<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $table = 'message';

    static public function addMessage($arr)
    {
        return self::insert($arr);
    }

    static public function getAll($skip,$page_size)
    {
        return self::skip($skip)->take($page_size)->orderBy('time','desc')->get();
    }

    static public function delMessage($id)
    {
        return self::where('id',$id)->delete();
    }

    //查询删除
    static public function getDel()
    {
        return self::onlyTrashed()->get();
    }

    //撤销删除
    static public function resDel($id)
    {
        return self::where('id',$id)->restore();
    }
}
