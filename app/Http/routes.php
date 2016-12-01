<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::match(['get','post','put'],'/', function () {
    $url = route("hello");
    return redirect()->route("hello");
    //return view('welcome')->with('msg',$url);
});

Route::get('/hello',['as'=>'hello',function(){
    return view('hello');
}]);

/*
 * 路由正则表达式
 */
Route::any('/hello/id/{id}/comments/{comment}',function($id,$commentid){
    return view("welcome")->with('msg','id:'.$id.'  comments:'.$commentid);
})->where(['id'=>'[0-9]+','comment'=>'[a-zA-Z]+']);

/**
 * 路由群组
 */
Route::group(['prefix'=>'admin'],function(){
    Route::get('user/{id}',function($id){
        return view('welcome')->with('msg',$id);
    });
});

/**
 * 访问MemberController
 */
Route::get('member/{id}','MemberController@info')->where('id','[0-9]+');

/**
 * 访问TaskController
 */
Route::get('task','TaskController@test1');
Route::get('query1','TaskController@query1');
Route::get('query2','TaskController@query2');
Route::get('query3','TaskController@query3');
Route::get('query4','TaskController@query4');
Route::get('orm1','TaskController@orm1');
Route::get('orm2','TaskController@orm2');
Route::get('orm3','TaskController@orm3');
Route::get('orm4','TaskController@orm4');
Route::get('section1','TaskController@section1');
Route::get('url1',['as'=>'url2','uses'=>'TaskController@urlTest']);
Route::any('task/request1',['uses'=>'TaskController@request1']);
Route::any('response',['uses'=>'TaskController@response']);
Route::any('upload',['uses'=>'StudentController@upload']);
Route::any('mail',['uses'=>'StudentController@mail']);
Route::any('cache1',['uses'=>'StudentController@cache1']);
Route::any('cache2',['uses'=>'StudentController@cache2']);

//宣传页面，不用放到中间件里面验证
Route::any('activity0',['uses'=>'TaskController@activity0']);
//活动页面
Route::group(['middleware'=>['activity']],function(){
    Route::any('activity1',['uses'=>'TaskController@activity1']);
    Route::any('activity2',['uses'=>'TaskController@activity2']);
});
Route::group(['middleware'=>['web']],function(){
    Route::any('session1',['uses'=>'TaskController@session1']);
    Route::any('session2',['as'=>'session2','uses'=>'TaskController@session2']);
});

//Route::get('member/info',['uses'=>'MemberController@info','as'=>'memberinfo']);
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::any('student/index',['uses'=>'StudentController@index']);
    Route::any('student/create',['uses'=>'StudentController@create']);
    Route::any('student/save',['uses'=>'StudentController@save']);
    Route::any('student/update/{id}',['uses'=>'StudentController@update']);
    Route::any('student/detail/{id}',['uses'=>'StudentController@detail']);
    Route::any('student/delete/{id}',['uses'=>'StudentController@delete']);
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
