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
	// 数据删除
	Route::delete('/{id}','ModelController@destory')->name('admin.destory');
	//图片上传
	Route::post('/upload','ModelController@upload')->name('admin.upload');
	// 后台首页
	Route::get('/','IndexController@index')->name('home');
	//后台用户首页
	Route::resource('/user','UserController');
		// 用户状态修改
		Route::post('/user/changestatu/{id}','UserController@changeStatu')->name('user.changStatu');
		// 用户搜索
		Route::match(['get', 'post'], '/user/search','UserController@search')->name('user.search');
	// 轮播图管理
	Route::resource('/slider','SliderController');
	// 最新资讯管理
	Route::resource('/news','NewsController');
	// 音乐单曲管理
	Route::resource('/music','MusicController');
	// 图片花絮管理
	Route::resource('/picture','PictureController');
	// 视频管理
	Route::resource('/video','VideoController');
	// 成员介绍管理
	Route::resource('/member','MemberController');
	// 清理缓存
	Route::get('/clearcache','ModelController@clearCache')->name('clearCache');
});
// 登陆
Auth::routes();
