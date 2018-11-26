<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 后台首页控制器
class IndexController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    // 后台首页页面
    public function index(){
    	return view('admin.index.index');
    }
}
