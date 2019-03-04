<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function addMessage()
    {
        $content = request()->input('content');
        $name = request()->input('name');
        if(!$content || !$name){
            return $this->fail(201);
        }
        $content = htmlentities($content);
        $name = htmlentities($name);
        if(strlen($name) > 30 || strlen($content) > 250){
            return $this->fail(210);
        }
        $time = date('Y-m-d H:i:s',time());
        $arr['content'] = $content;
        $arr['name'] = $name;
        $arr['time'] = $time;
        try {
            Message::addMessage($arr);
            return $this->success();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function getAllMessage()
    {
        $page = $this->getPage();

        $page_size = $this->getPageSize();

        $skip = $page_size*($page-1);

        if($page == 1){
            $skip = 0;
        }

        $res = Message::getAll($skip,$page_size);
        $count = Message::count();
        return $this->successForArticle($count,$page,$page_size,$res);
    }

    public function del()
    {
        $id = request()->input('id');
        if(!$id){
            return $this->fail(201);
        }
        Message::delMessage($id);
        return $this->success();
    }

    public function redel()
    {
        $id = request()->input('id');
        if(!$id){
            return $this->fail(201);
        }
        Message::resDel($id);
        return $this->success();
    }

    public function getDel()
    {
        $page = $this->getPage();

        $page_size = $this->getPageSize();

        $res = Message::getDel();
        $count = count($res);
        return $this->successForArticle($count,$page,$page_size,$res);
    }
}
