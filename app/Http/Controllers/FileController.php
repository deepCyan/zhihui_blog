<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        try {
            $path = $request->file('img')->store('public');
            $real_path = Storage::url($path);
            $arr['img_url'] = 'https://'.$_SERVER['SERVER_NAME'].'/blog/public'.$real_path;
            return $this->success($arr);
        } catch (\Throwable $th) {
            //throw $th;
            return $this_>fail(207);
        }
    }

    public function delFile($url){
        if($url){
            $file_name = substr($url,48);
        }
        try {
            Storage::delete($file_name);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
