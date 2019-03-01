<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function getAnswer()
    {
        $id = request()->input('id');
        if(!$id){
            return $this->fail(201);
        }
        try {
            //code...
            $res = Answer::getAnswer($id);
            return $this->success($res);
        } catch (\Throwable $th) {
            throw $th;
            return $this->fail(300);
        }
    }

    public function addAnswer()
    {
        $article_id = request()->input('article_id');
        //回复评论 评论的id 如果回复主题文章 不传此参数 设为0
        $answer_id = request()->input('answer_id') ?? 0;
        $user_id = request()->input('user_id');
        $content = request()->input('content');
        if(!$article_id || !$user_id || !$content){
            return $this->fail(201);
        }
        $arr['article_id'] = $article_id;
        $arr['answer_id'] = $answer_id;
        $arr['user_id'] = $user_id;
        $arr['content'] = $content;
        try {
            $res = Answer::addAnswer($arr);
            return $this->success();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}