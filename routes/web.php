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

Route::prefix('back')->namespace('Back')->group(function(){
   Route::get('category', 'CategoryController@index')
        ->name('back-category-index');
});
