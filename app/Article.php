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
                    ->select('article.id','user.id as user_id','title','time','class_id','name as author_name','watch','last_watch','foreword','foreimg')
                    ->get();
    }

    //取单个
    static public function findById($id)
    {
        return self::join('user','user.id','=','article.author_id')
                    ->where('article.id',$id)
                    ->select('article.id','user.id as user_id','title','time','class_id','name as author_name','watch','content','last_watch','foreword')
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
    static public function findBySome($field,$where,$skip,$page_size,$like=true)
    {
        $res = [];
        if($like){
            $res = self::where($field,'like','%'.$where.'%');
        }else{
            $res = self::where($field,$where);
        }
        return $res->skip($skip)
                    ->take($page_size)
                    ->join('user','user.id','=','article.author_id')
                    ->select('article.id','user.id as user_id','title','time','class_id','foreword','foreimg')
                    ->orderBy('article.id','desc')
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
    static public function getDel($skip,$page_size)
    {
        return self::onlyTrashed()->take($page_size)->skip($skip)->get();
    }

    //删除的数目
    static public function getDelNum(){
        return self::onlyTrashed()->count();
    }

    //撤销删除
    static public function resDel($id)
    {
        return self::where('id',$id)->restore();
    }

    //取上一条
    static public function getLast($id,$class_id)
    {
        return self::where('id','<',$id)->where('class_id',$class_id)->orderBy('id','desc')->first();
    }

    //取下一条
    static public function getNext($id,$class_id)
    {
        return self::where('id','>',$id)->where('class_id',$class_id)->first();
    }

    //修改
    static public function changeArticle($id,$arr)
    {
        return self::where('id',$id)->update($arr);
    }
}