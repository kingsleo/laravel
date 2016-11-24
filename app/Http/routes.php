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
});
