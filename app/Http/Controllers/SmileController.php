<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Smile;

class SmileController extends Controller
{
    public function getAll()
    {
        $page = $this->getPage();

        $page_size = $this->getPageSize();

        $skip = $page_size*($page-1);

        if($page == 1){
            $skip = 0;
        }

        try {
            $res = Smile::getAll($skip,$page_size);
            $count = Smile::count();
            return $this->successForArticle($count,$page,$page_size,$res);
        } catch (\Throwable $th) {
            //  throw $th;
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
            Smile::delSmile($id);
            return $this->success();
        } catch (\Throwable $th) {
            //  throw $th;
            return $this->fail(300);
        }
    }

    public function redel()
    {
        $id = request()->input('id');
        if(!$id){
            return $this->fail(201);
        }
        try {
            Smile::resDel($id);
            return $this->success();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function getDel()
    {
        $page = $this->getPage();

        $page_size = $this->getPageSize();

        $res = Smile::getDel();
        $count = count($res);
        return $this->successForArticle($count,$page,$page_size,$res);
    }

    public function change($arr,$id)
    {
        $id = request()->input('id');
        if(!$id){
            return $this->fail(201);
        }
        $content = request()->input('content');
        $img = request()->input('content');
        if($content){
            $arr['content'] = $content;
        }
        if($img){
            $arr['img'] = $img;
        }
        if($content || $img){
            try {
                Smile::changeSmile($id,$arr);
                return $this->success();
            } catch (\Throwable $th) {
                //throw $th;
                return $this->fail(300);
            }
        }else{
            return $this->fail(201);
        }
    }

    public function addSmile()
    {
        $content = request()->input('content');
        $user_name = request()->input('name');
        if(!$content || !$user_name){
            return $this->fail(201);
        }
        $arr['content'] = $content;
        $arr['user_name'] = $user_name;
        $arr['time'] = date('Y-m-d H:i:s',time());
        $img = request()->input('img');
        if($img){
            $arr['img'] = $img;
        }
        Smile::addSmile($arr);
        return $this->success();
    }
}