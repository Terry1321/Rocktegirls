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
// 前台首页
Route::get('/','home\IndexController@index')->name('home.index');


// 后台,'middleware'=>'IndexMiddleware'
Route::group(['namespace'=>'admin','prefix'=>'admin'],function(){
	// 后台首页
	Route::get('/','IndexController@index')->name('admin.index');
	//后台用户首页
	Route::resource('/user','UserController');
		// 用户状态修改
		Route::post('/user/changestatu/{id}','UserController@changeStatu')->name('user.changStatu');
		// 用户搜索
		Route::match(['get', 'post'], '/user/search','UserController@search')->name('user.search');
	// 轮播图管理
	Route::resource('/slider','SliderController');
});