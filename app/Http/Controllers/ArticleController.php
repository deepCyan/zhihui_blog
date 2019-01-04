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
        $finder = request()->input('finder');
        if(!$finder){
            return $this->fail(201);
        }

        $page = $this->getPage();

        $page_size = $this->getPageSize();

        $skip = $page_size*$page;

        if($page == 1){
            $skip = 0;
        }

        $res = Article::findByTitle($finder,$skip,$page_size);
        $count = Article::getFindCount($finder,'title',true);

        if($res){
            return $this->successForArticle($count,$page,$page_size,$res);
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
        $res = Article::addArticle($arr);
        if($res){
            $this->success();
        }else{
            $this->fail(300);
        }
    }
}
