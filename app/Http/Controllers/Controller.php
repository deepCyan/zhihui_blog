<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $page = 1;

    protected $page_size = 50;

    public function success($data = []){
        return [
            'status'  => true,
            'code'    => 200,
            'message' => config('errorcode.code')[200],
            'data'    => $data,
        ];
    }

    public function successForArticle($total,$page,$page_size,$data=[])
    {
        return [
            'status'    => true,
            'code'      => 200,
            'message'   => config('errorcode.code')[200],
            'total'     => $total,
            'page'      => $page,
            'page_size' => $page_size,
            'data'      => $data,
        ];
    }

    public function fail($code, $data = []){
        return [
            'status'  => false,
            'code'    => $code,
            'message' => config('errorcode.code')[(int) $code],
            'data'    => $data,
        ];
    }

    public function successForUpload($url){
        return [
            'errno' => 0,
            'data'  => [$url]
        ];
    }

    public function getPage()
    {
        
        return $page = request()->input('page') ?? $this->page;
    }

    public function getPageSize()
    {
        # code...
        return $page_size = request()->input('page_size') ?? $this->page_size;
    }

}
