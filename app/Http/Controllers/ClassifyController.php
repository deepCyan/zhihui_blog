<?php

namespace App\Http\Controllers;

use App\Classify;
use Illuminate\Http\Request;

class ClassifyController extends Controller
{
    public function getAll()
    {
        $res = Classify::getAll();
        if($res){
            return $this->success($res);
        }else{
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
}
