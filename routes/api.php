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

Route::get('/norole','UserController@noRole')->name('norole');

Route::get('/setdata','RedisController@setData');

Route::get('/getLast','ArticleController@getLast')->name('getLast');

Route::get('/getNext','ArticleController@getNext')->name('getNext');

Route::get('/getdata','RedisController@getData');

Route::get('/getTree','ClassifyController@treeClassify')->name('getTree');

Route::get('/getSonClassify','ClassifyController@getSonClassify')->name('getSon');

Route::get('/test','RedisController@test');

Route::get('/getAllSmile','SmileController@getAll')->name('getSmile');

Route::get('/addMessage','MessageController@addMessage')->name('addMessage');

Route::get('/getAllMessage','MessageController@getAllMessage')->name('getAllMessage');

Route::group(['middleware' => 'checklogin'],function(){
    Route::post('/addArticle','ArticleController@addArticle')->name('addArticle');

    Route::post('/upload','UserController@upload')->name('upload');

    Route::post('/addAnswer','AnswerController@addAnswer')->name('addAnswer');

    Route::get('/changeUserInfo','UserController@changeUserInfo')->name('changeUserInfo');
});

Route::group(['middleware' => 'checkadmin'],function(){
    Route::get('/getDel','ArticleController@getDel')->name('getDel');

    Route::get('/delArticle','ArticleController@del')->name('delArticle');

    Route::get('/restoreDel','ArticleController@restoreDel')->name('restoreDel');

    Route::get('/addParent','ClassifyController@addParent')->name('addParent');

    Route::get('/addSon','ClassifyController@addSon')->name('addSon');

    Route::get('/changeClassify','ClassifyController@changeInfo')->name('changeInfo');

    Route::get('/delClassify','ClassifyController@delClassify')->name('delClassify');

    Route::get('/delSmile','SmileController@del')->name('delSmile');

    Route::get('/resdelSmile','SmileController@redel')->name('resdelSmile');

    Route::get('/getdelSmile','SmileController@getDel')->name('getdelSmile');

    Route::get('/addSmile','SmileController@addSmile')->name('addSmile');

    Route::get('/changeSmile', 'SmileController@changeSmile');    

    Route::get('/delMessage','MessageController@del')->name('delMessage');

    Route::get('/redelMessage','MessageController@redel')->name('redelMessage');

    Route::get('/getDelMessage','MessageController@getDel')->name('getDelMessage');

    Route::post('/changeArticle', 'ArticleController@changeArticle');
});