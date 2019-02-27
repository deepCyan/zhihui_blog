<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classify extends Model
{
    protected $table = 'classify';

    public $timestamps = false;

    static public function getAll($field = null,$where = null)
    {
        if($field){
            return self::where($field,$where)->get();
        }else{
            return self::get();
        }
    }

    static public function addClassify($arr)
    {
        return self::insert($arr);
    }

    static public function change($id,$arr)
    {
        return self::where('id',$id)->update($arr);
    }

    static public function getSon($parent_id)
    {
        return self::where('parent_id',$parent_id)->get();
    }

    static public function read_del($id)
    {
        return self::where('id',$id)->delete();
    }
}