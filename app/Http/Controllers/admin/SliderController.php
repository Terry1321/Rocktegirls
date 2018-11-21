<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 轮播图管理控制器
class SliderController extends Controller
{
	//轮播图管理首页
    public function index(){
    	/*获取总数*/
    	$count=DB::table('slider')->count();
    	/*获取分页数据*/
    	$paginate=DB::table('slider')->orderBy('sort','desc')->paginate(6);
    	// 整理数据
    	$data=array(
    		"count"=>$count,
    		"paginate"=>$paginate,
    	);
    	/*返回数据给页面*/
    	return view('admin.slider.index')->with('data',$data);
    }

    // 轮播图删除操作
    public function destroy($id){
    	// id如果获取成功
    	if ($id) {
    		// 如果删除成功
    		if (DB::table('slider')->where('id',$id)->delete()) {
    			return 1;
    		}else{
    			return 0;
    		}
    	}else{
    		return 0;
    	}
    }

    //轮播图添加页面
    public function create(){
		return view('admin.slider.create');    	
    } 
}
