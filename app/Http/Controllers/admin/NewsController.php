<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 最新资讯控制器
class NewsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
   //最新资讯首页
    public function index(){
    	/*获取总数*/
    	$count=DB::table('news')->count();
    	/*获取分页数据*/
    	$paginate=DB::table('news')->orderBy('sort','asc')->paginate(6);
    	// 整理数据
    	$data=array(
    		"count"=>$count,
    		"paginate"=>$paginate,
    	);
    	/*返回数据给页面*/
    	return view('admin.news.index')->with('data',$data);
    }

    //最新资讯添加页面
	 public function create(){
	 	return view('admin.news.create');
	 }

    //最新资讯修改页面
	 public function edit($id){
 		// 获取对应数据
	 	$data=DB::table('news')->where('id',$id)->first();
        $data->id=$id;
	 	// 返回视图和信息
	 	return view('admin.news.edit')->with('data',$data);
	 }

   // 最新资讯添加操作
     public function store(Request $request){
        // 表单传送过来的数据
        $data=$request->except('_token');
        // 表单验证规则
        $rule=[
            'title'=>'required',
            'href'=>'required|url',
            'description'=>'required',
            'sort'=>'required|numeric',
            'img'=>'required',
        ];
        // 表单验证错误信息->\app\Http\Controllers\admin\ModelController
        $message=ModelController::message(); 
        // 生成表单验证
        $validator=\Validator::make($data,$rule,$message);
        // 如果通过表单验证
        if ($validator->passes()) {
            $data['createtime']=time();
            if (DB::table('news')->insert($data)){
                return redirect('admin/news');
            }else{
                return back();
            }
        }else{
            // 返回错误信息
            return back()->withInput()->withErrors($validator); 
        }
     } 

     /*最新资讯修改操作*/
   public function update(Request $request,$id){
        // 表单传送过来的数据
        $data=$request->except('_token','_method','oldImg');//排除token，method，oldimg
         /*
            验证规则
            required 不能为空
            numeric 只能数数字
            url 只能是有效链接
        */
          $rule=[
            'title'=>'required',
            'href'=>'required|url',
            'description'=>'required',
            'sort'=>'required|numeric',
        ];
        /*验证信息*/
        $message=ModelController::message();
        // 生成表单验证
        $validator=\Validator::make($data,$rule,$message);
        // 如果通过表单验证
        if ($validator->passes()) {
           // 获取旧图片名字
            $oldImg=$request->input('oldImg');
            // 获取新图片名字
            $img=$request->input('img');
            if (isset($img)) {
                // 修改数据库
                if (DB::table('news')->where('id',$id)->update($data)){
                   // 判断旧图片是否存在
                   if (file_exists('./Upload/news/'.$oldImg)) {
                    // 若存在删除
                        unlink('./Upload/news/'.$oldImg);
                    }
                    return redirect('admin/news');
                }else{
                    return back();
                }
            }else{
              // 整理数据
                $data['img']=$request->input('oldImg');
                //修改数据库
                if (DB::table('news')->where('id',$id)->update($data)) {
                   return redirect('admin/news');
                }else{
                    return back();
                }
            }
        }else{
            // 返回错误信息
            return back()->withInput()->withErrors($validator); 
        }
    }  
}
