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


Route::get('user/login','User@login');
Route::post('user/logins','User@logins');

Route::get('user/create','User@create');
Route::post('user/store','User@store');
Route::get('user/index','User@index');
Route::any('user/destroy/{uid}','User@destroy');
Route::any('user/edit/{uid}','User@edit');
Route::post('user/update/{uid}','User@update');


Route::get('puser/create','Puser@create');
Route::post('puser/store','Puser@store');
Route::get('puser/index','Puser@index');
Route::any('puser/destroy/{user_id}','Puser@destroy');
Route::any('puser/edit/{user_id}','Puser@edit');
Route::post('puser/update/{user_id}','Puser@update');