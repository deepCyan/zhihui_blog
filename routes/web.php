<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login','UserController@login')->name('login');

Route::get('/login2','UserController@login2')->name('login2');

Route::get('/res','UserController@res')->name('res');

Route::get('/nologin','UserController@nologin')->name('nologin');

Route::get('/allArticle','ArticleController@getAllArticle')->name('getAllArticle');

Route::get('/findByTitle','ArticleController@findByTitle')->name('findByTitle');

Route::group(['middleware' => 'checklogin'],function(){
    //这里的路由都经过checklogin
    
});