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
Route::get('student/create','Student@create');
Route::post('student/save','Student@save');
Route::get('student/index','Student@index');
Route::any('student/destroy/{s_id}','Student@destroy');
Route::any('student/edit/{s_id}','Student@edit');
Route::post('student/update/{s_id}','Student@update');

//登录
Route::get('user/login','UserController@login');
Route::post('user/logins','UserController@logins');
//注册
Route::get('user/create','UserController@create');
Route::post('user/store','UserController@store');
Route::get('user/index','UserController@index');
Route::any('user/destroy/{uid}','UserController@destroy');
Route::any('user/edit/{uid}','UserController@edit');
Route::post('user/update/{uid}','UserController@update');

Route::get('user/showProfile','UserController@showProfile');

Route::get('user/showProfile','UserController@showProfile');
Route::get('puser/create','Puser@create');
Route::post('puser/store','Puser@store');
Route::get('puser/index','Puser@index');
Route::any('puser/destroy/{user_id}','Puser@destroy');
Route::any('puser/edit/{user_id}','Puser@edit');
Route::post('puser/update/{user_id}','Puser@update');


//商品表
Route::get('goods/create','Goods@create');
Route::post('goods/store','Goods@store');
Route::get('goods/index','Goods@index');
Route::any('goods/destroy/{goods_id}','Goods@destroy');
Route::any('goods/edit','Goods@edit');
Route::post('goods/update','Goods@update');











































