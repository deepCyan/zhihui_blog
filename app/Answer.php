<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'user';

    static public function getAnswer($id)
    {
        return self::where('article_id',$id)->get();
    }

    static public function addAnswer($arr)
    {
        return self::insert($arr);
    }
}
