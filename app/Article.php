<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'article';

    const UPDATED_AT = 'last_watch';

    protected $dates = ['deleted_at'];
    //取所有
    static public function getAll($skip,$page_size)
    {
        return self::skip($skip)
                    ->take($page_size)
                    ->join('user','user.id','=','article.author_id')
                    ->select('article.id','user.id as user_id','title','time','class_id','name as author_name','watch','last_watch')
                    ->get();
    }

    //取单个
    static public function findById($id)
    {
        return self::join('user','user.id','=','article.author_id')
                    ->where('article.id',$id)
                    ->select('article.id','user.id as user_id','title','time','class_id','name as author_name','watch','content','last_watch')
                    ->get();
    }
    //修改浏览量
    static public function addWatch($id)
    {
        return self::where('id',$id)->increment('watch',1);
    }
    //统计数量
    static public function getFindCount($field=null,$where=null,$like=false)
    {
        if($like){
            return self::where($field,'like','%'.$where.'%')->count();
        }else{
            return self::where($field,$where)->count();
        }
    }

    //查询
    static public function findBySome($field,$where,$skip,$page_size)
    {
        return self::where($field,'like','%'.$where.'%')
                    ->skip($skip)
                    ->take($page_size)
                    ->join('user','user.id','=','article.author_id')
                    ->select('article.id','user.id as user_id','title','time','class_id')
                    ->get();
    }

    //添加
    static public function addArticle($arr)
    {
        return self::insert($arr);
    }

    //删除
    static public function delArticle($id)
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