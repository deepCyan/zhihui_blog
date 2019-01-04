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
}
