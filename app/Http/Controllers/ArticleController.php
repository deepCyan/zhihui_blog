<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function getAllArticle()
    {
        $page = $this->getPage();

        $page_size = $this->getPageSize();

        $skip = $page_size*$page;

        if($page == 1){
            $skip = 0;
        }

        $res = Article::getAll($skip,$page_size);
        $count = Article::count();

        if($res){
            return $this->successForArticle($count,$page,$page_size,$res);
        }else{
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

        $skip = $page_size*$page;

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

        $skip = $page_size*$page;

        if($page == 1){
            $skip = 0;
        }

        $res = Article::findBySome('class_id',$class_id,$skip,$page_size);
        $count = Article::getFindCount('class_id',$class_id);

        if($res){
            return $this->successForArticle($count,$page,$page_size,$res);
        }else{
            return $this->fail(300);
        }
    }

    public function findById()
    {
        $id = request()->input('id');
        if(!$id){
            return $this->fail(201);
        }
        $getwtach = Article::addWatch($id);
        $res = Article::findById($id);
        if($res){
            return $this->success($res);
        }else{
            return $this->fail(300);
        }
    }

    public function addArticle()
    {
        $author_id = request()->input('author_id');
        $title = request()->input('title');
        $content = request()->input('content');
        $class_id = request()->input('class_id');
        if (!$author_id || !$title || !$content || !$class_id) {
            return $this->fail(201);
        }

        $time = date('Y-m-d H:i:s',time());
        $arr['author_id'] = $author_id;
        $arr['title'] = $title;
        $arr['content'] = $content;
        $arr['class_id'] = $class_id;
        $arr['time'] = $time;
        
        try {
            //code...
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
        $res = Article::delArticle($id);
        if($res){
            return $this->success();
        }else{
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
            return $this->success($res);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }
}
