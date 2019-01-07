<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classify extends Model
{
    protected $table = 'classify';

    static public function getAll($field = null,$where = null)
    {
        if($field){
            return self::where($field,$where)->get();
        }else{
            return self::get();
        }
    }
}