<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/',function(){
    echo '<h1>看个毛毛球呀</h1>';
});

Route::get('/login','UserController@login')->name('login');

Route::get('/login2','UserController@login2')->name('login2');

Route::get('/res','UserController@res')->name('res');

Route::get('/nologin','UserController@nologin')->name('nologin');

Route::get('/allArticle','ArticleController@getAllArticle')->name('getAllArticle');

Route::get('/findByTitle','ArticleController@findByTitle')->name('findByTitle');

Route::post('/upload','UserController@upload')->name('upload');

Route::group(['middleware' => 'checklogin'],function(){
    //这里的路由都经过checklogin
    Route::post('/addArticle','ArticleController@addArticle')->name('addArticle');
});