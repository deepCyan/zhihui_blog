<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Smile extends Model
{
    use SoftDeletes;

    protected $table = 'smile';

    protected $dates = ['deleted_at'];

    static public function addSmile($arr)
    {
        return self::insert($arr);
    }

    static public function getAll($skip,$page_size)
    {
        return self::skip($skip)
                    ->take($page_size)
                    ->orderBy('id','desc')
                    ->get();
    }

    static public function changeSmile($id,$arr)
    {
        return self::where('id',$id)->update($arr);
    }

    static public function delSmile($id)
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
