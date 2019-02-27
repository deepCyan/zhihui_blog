<?php

namespace App\Http\Controllers;

use App\Classify;
use App\Article;
use Illuminate\Http\Request;

class ClassifyController extends Controller
{
    public function getAll()
    {
        try {
            $res = Classify::getAll();
            return $this->success($res);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function getAllParents()
    {
        $res = Classify::getAll('parent_id',0);
        if($res){
            return $this->success($res);
        }else{
            return $this->fail(300);
        }
    }

    public function addParent()
    {
        $name = request()->input('name');
        if(!$name){
            return $this->fail(201);
        }
        $arr['name'] = $name;
        $arr['parent_id'] = 0;
        $arr['path'] = '0,';
        try {
            Classify::addClassify($arr);
            return $this->success();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function addSon()
    {
        $name = request()->input('name');
        $parent_id = request()->input('parent_id');
        if(!$name || !$parent_id){
            return $this->fail(201);
        }
        $arr['name'] = $name;
        $arr['parent_id'] = $parent_id;
        $arr['path'] = '0,'.$parent_id.',';
        try {
            Classify::addClassify($arr);
            return $this->success();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail(300);
        }
    }

    public function changeInfo()
    {
        $id = request()->input('id');
        if(!$id){
            return $this->fail(201);
        }
        $name = request()->input('name');
        $parent_id = request()->input('parent_id');
        if(!$name || !$parent_id){
            return $this->fail(201);
        }
        $arr = array();
        if($name){
            $arr['name'] = $name;
        }
        if($parent_id){
            $arr['parent_id'] = $parent_id;
        }
        try {
            Classify::change($id,$arr);
            return $this->success();
        } catch (\Throwable $th) {
            throw $th;
            //  return $this->fail(300);
        }
    }

    public function delClassify()
    {
        $class_id = request()->input('id');
        if(!$class_id){
            return $this->fail(201);
        }
        //  检查是否有资源
        $res = Article::findBySome('class_id',$class_id,0,1);
        if(count($res)>0){
            return $this->fail(208);
        }
        //  检查是否有子类
        $son = Classify::getSon($class_id);
        if(count($son)>0){
            return $this->fail(209);
        }
        //  删除
        Classify::read_del($class_id);
        return $this->success();
    }
}
