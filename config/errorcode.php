<?php
    return [

        /*
        |--------------------------------------------------------------------------
        | customized http code
        |--------------------------------------------------------------------------
        |
        | The first number is error type, the second and third number is
        | product type, and it is a specific error code from fourth to
        | sixth.But the success is different.
        |
        */
    
        'code' => [
            100 => '系统异常',
            200 => '成功',
            201 => '缺少必要参数',
            202 => '用户未注册',
            203 => '验证未通过',
            204 => '用户未登录',
            205 => '用户已存在',
            206 => '权限不足',
            207 => '图片上传异常',
            208 => '分类下有资源',
            209 => '分类下有子类',
            210 => '数据长度超限',
            //DB
            300 => '数据库操作异常',
        ],
    
    ];