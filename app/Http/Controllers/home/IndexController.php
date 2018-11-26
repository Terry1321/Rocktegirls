<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

// 前台首页控制器
class IndexController extends Controller{
	// 写入缓存
	public function cache($name,$time=60*24){
		// 判断是否存在
	      if (\Cache::get($name)) {
	            $return=\Cache::get($name);
	        }else{
	        	if ($name=='video'||$name=='picture') {
	        		// 获取数据
	        		$data=DB::table($name)->orderBy('sort','asc')->limit(12)->get();
	        		// 整理数据(有点小bug)
	        		for ($i=0; $i <3 ; $i++) { 
	        			for ($j=$i*4; $j <($i+1)*4 ; $j++) { 
	        				$return[$i][$j]=$data[$j];
	        			}
	        		}
	        	}else{	
		          	$return=DB::table($name)->orderBy('sort','asc')->get();

	        	}
	        	// 放入缓存
		            \Cache::put($name,$return,$time);
	        }
	        //返回数据
	        return $return;
	}	
     // 前台首页页面
    public function index(){
		// 
		$news=$return=DB::table('news')->orderBy('sort','asc')->simplePaginate(6);//经常变动不能使用缓存
		// 使用缓存减少数据库访问次数
    	//使用cache函数减少冗余
		$slider=$this->cache('slider');
        $member=$this->cache('member');
        $music=$this->cache('music');

        $video=$this->cache('video');
        $picture=$this->cache('picture');

    	$data=array(
    		'slider'=>$slider,
    		'news'=>$news,
    		'member'=>$member,
            'music'=>$music,
            'video'=>$video,
            'picture'=>$picture,
    	);
    	return view('home.index')->with('data',$data);
    }
}
