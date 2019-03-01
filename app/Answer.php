<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answer';

    static public function getAnswer($id)
    {
        return self::join('user','user.id','=','answer.user_id')
                    ->where('answer.article_id',$id)
                    ->select('answer.id','user.name','user.id as user_id','content','article_id','answer_id')
                    ->get();
    }

    static public function addAnswer($arr)
    {
        return self::insert($arr);
    }
}
