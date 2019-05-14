<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ArticleController extends Controller
{
    public function getAllArticle()
    {
        $page = $this->getPage();

        $page_size = $this->getPageSize();

        $skip = $page_size*($page-1);

        if($page == 1){
            $skip = 0;
        }

        try {
            $res = Article::getAll($skip,$page_size);
            $count = Article::count();
            return $this->successForArticle($count,$page,$page_size,$res);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function findByTitle()
    {
        $find_title = request()->input('title');
        if(!$find_title){
            return $this->fail(201);
        }

        $page = $this->getPage();

        $page_size = $this->getPageSize();

        $skip = $page_size*($page-1);

        if($page == 1){
            $skip = 0;
        }

        $res = Article::findBySome('title',$find_title,$skip,$page_size);
        $count = Article::getFindCount('title',$find_title,true);

        if($res){
            return $this->successForArticle($count,$page,$page_size,$res);
        }else{
            return $this->fail(300);
        }
    }

    public function findByClassify()
    {
        $class_id = request()->input('class_id');
        if(!$class_id){
            return $this->fail(201);
        }
        $page = $this->getPage();

        $page_size = $this->getPageSize();

        $skip = $page_size*($page-1);

        if($page == 1){
            $skip = 0;
        }

        try {
            $res = Article::findBySome('class_id',$class_id,$skip,$page_size,false);
            $count = Article::getFindCount('class_id',$class_id);
            return $this->successForArticle($count,$page,$page_size,$res);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function findById()
    {
        $id = request()->input('id');
        if(!$id){
            return $this->fail(201);
        }
        try{
            $getwtach = Article::addWatch($id);
            $res = Article::findById($id);
            return $this->success($res);
        }catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function addArticle()
    {
        $author_id = request()->input('author_id');
        $title = request()->input('title');
        $content = request()->input('content');
        $class_id = request()->input('class_id');
        $foreword =request()->input('foreword');
        $foreimg =request()->input('foreimg');

        if (!$author_id || !$title || !$content || !$class_id || !$foreword) {
            return $this->fail(201);
        }

        //规避xss
        $rel_title = htmlentities($title);
        $time = date('Y-m-d H:i:s',time());
        $arr['author_id'] = $author_id;
        $arr['title'] = $rel_title;
        $arr['content'] = $content;
        $arr['class_id'] = $class_id;
        $arr['time'] = $time;
        $arr['foreword'] = $foreword;
        $arr['foreimg'] = $foreimg;
        
        try {
            Article::addArticle($arr);
            return $this->success();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function del()
    {
        $id = request()->input('id');
        if(!$id){
            return $this->fail(201);
        }
        try {
            Article::delArticle($id);
            return $this->success();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function restoreDel()
    {
        $id = request()->input('id');
        if(!$id){
            return $this->fail(201);
        }
        try {
            $res = Article::resDel($id);
            return $this->success();
        } catch (\Throwable $th) {
            throw $th;
            return $this->fail(300);
        }
    }

    public function getDel()
    {
        $page = $this->getPage();

        $page_size = $this->getPageSize();

        try {
            $res = Article::getDel();
            $count = count($res);
            return $this->successForArticle($count,$page,$page_size,$res);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function getLast(){
        $id = request()->input('id');
        $class_id = request()->input('class_id');
        if(!$id){
            return $this->fail(201);
        }
        try {
            $res = Article::getLast($id,$class_id);
            return $this->success($res);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }

    }

    public function getNext()
    {
        $id = request()->input('id');
        $class_id = request()->input('class_id');
        if(!$id){
            return $this->fail(201);
        }
        try {
            $res = Article::getNext($id,$class_id);
            return $this->success($res);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function changeArticle()
    {
        $id = request()->input('id');
        if(!$id){
            return $this->fail(201);
        }
        $arr = array();
        $author_id = request()->input('author_id');
        $title = request()->input('title');
        $class_id = request()->input('class_id');
        $content = request()->input('content');
        $foreword = request()->input('foreword');
        if($author_id){
            $arr['author_id'] = $author_id;
        }
        if($title){
            $arr['title'] = $title;
        }
        if($class_id){
            $arr['class_id'] = $class_id;
        }
        if($content){
            $arr['content'] = $content;
        }
        if($foreword){
            $arr['foreword'] = $foreword;
        }
        Article::changeArticle($id,$arr);
        return $this->success();
    }

    //  规定参数只能是数组
    public function mustArr(array $arr)
    {
        
    }

    //  规定参数只能是Request的实例
    public function mustReq(Request $requset)
    {
        
    }
}
