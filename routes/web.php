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


Route::get('/action','Test\RouteController@action');
Route::get('/hello','Test\RouteController@hello')->middleware('token');
Route::get('user/{id}', function($id) {
    return 'User' . $id;
});

Route::prefix('back')->namespace('Back')->group(function(){
   Route::get('category', 'CategoryController@index')
        ->name('back-category-index');
});

Route::group(['middlewqare' =>['blog']],function(){
    Route::get('/',function(){
        return view('welcome', ['website'=>'Laravel']);
    });
    Route::view('/view', 'welcome',['website' => 'Laravel学院']);
});

Route::get('form_without_csrf_token', function (){
    return '<form method="POST" action="/hello_from_form"><button type="submit">提交</button></form>';
});

Route::get('form_with_csrf_token', function () {
    return '<form method="POST" action="/hello_from_form">' . csrf_field() . '<button type="submit">提交</button></form>';
});

Route::post('hello_from_form', function (){
    return 'hello laravel!';
});

Route::get('cookie/add', function() {
    $minutes = 24 * 60;
    return response('欢迎来到laravel学院')->cookie('name','学院君', $minutes);
});

Route::get('cookie/get', function(\Illuminate\Http\Request $request) {
    $cookie = $request->cookie('name');
    dd($cookie);
});

Route::get('profile', function(){
    return response('欢迎来到laravel学院');
});

Route::get('foo', 'Photos\AdminController@method');






















