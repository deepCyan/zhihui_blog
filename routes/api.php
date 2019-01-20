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

Route::get('/findByClass','ArticleController@findByClassify')->name('findByClassify');

Route::get('/getAllClassify','ClassifyController@getAll')->name('getAllClassify');

Route::get('/getAllParent','ClassifyController@getAllParents')->name('getParentClass');

Route::get('/getArticle','ArticleController@findById')->name('getArticle');

Route::get('/getAnswer','AnswerController@getAnswer')->name('getAnswer');

Route::group(['middleware' => 'checklogin'],function(){
    //这里的路由都经过checklogin
    Route::post('/addArticle','ArticleController@addArticle')->name('addArticle');

    Route::get('/delArticle','ArticleController@del')->name('delArticle');

    Route::get('/restoreDel','ArticleController@restoreDel')->name('restoreDel');

    Route::post('/upload','UserController@upload')->name('upload');

    Route::post('/addAnswer','AnswerController@addAnswer')->name('addAnswer');

    Route::get('/changeUserInfo','UserController@changeUserInfo')->name('changeUserInfo');
});