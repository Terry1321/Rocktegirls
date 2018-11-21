<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 前台首页控制器
class IndexController extends Controller
{
     // 前台首页页面
    public function index(){
    	return view('home.index');
    }
}
