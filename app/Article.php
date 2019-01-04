<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'article';

    //取所有
    static public function getAll($skip,$page_size)
    {
        return self::skip($skip)
                    ->take($page_size)
                    ->join('user','user.id','=','article.author_id')
                    ->select('article.id','user.id as user_id','title','time','class_id')
                    ->get();
    }

    //统计数量
    static public function getFindCount($where=null,$field=null,$like=false)
    {
        if($like){
            return self::where($field,'like','%'.$where.'%')->count();
        }else{
            return self::where($field,$where)->count();
        }
    }

    //查询
    static public function findByTitle($title,$skip,$page_size)
    {
        return self::where('title','like','%'.$title.'%')
                    ->skip($skip)
                    ->take($page_size)
                    ->join('user','user.id','=','article.author_id')
                    ->select('article.id','user.id as user_id','title','time','class_id')
                    ->get();
    }
}