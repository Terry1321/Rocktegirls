<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 图片花絮控制器
class PictureController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
   //图片花絮首页
    public function index(){
    	/*获取总数*/
    	$count=DB::table('picture')->count();
    	/*获取分页数据*/
    	$paginate=DB::table('picture')->orderBy('sort','desc')->paginate(6);
    	// 整理数据
    	$data=array(
    		"count"=>$count,
    		"paginate"=>$paginate,
    	);
    	/*返回数据给页面*/
    	return view('admin.picture.index')->with('data',$data);
    }

    //图片花絮添加页面
	 public function create(){
	 	return view('admin.picture.create');
	 }

    //图片花絮修改页面
	 public function edit($id){
 		// 获取对应数据
	 	$data=DB::table('picture')->where('id',$id)->first();
        $data->id=$id;
	 	// 返回视图和信息
	 	return view('admin.picture.edit')->with('data',$data);
	 }

      // 图片花絮添加操作
     public function store(Request $request){
        // 表单传送过来的数据
        $data=$request->except('_token');
        // 表单验证规则
        $rule=[
            'title'=>'required',
            'sort'=>'required|numeric',
            'img'=>'required',
        ];
        // 表单验证错误信息
        $message=ModelController::message(); 
        // 生成表单验证
        $validator=\Validator::make($data,$rule,$message);
        // 如果通过表单验证
        if ($validator->passes()) {
            if (DB::table('picture')->insert($data)){
                return redirect('admin/picture');
            }else{
                return back();
            }
        }else{
            // 返回错误信息
            return back()->withInput()->withErrors($validator); 
        }
     } 

 /*图片花絮修改操作*/
   public function update(Request $request,$id){
        // 表单传送过来的数据
        $data=$request->except('_token','_method','oldImg');//排除token，method，oldimg
         /*
            验证规则
            required 不能为空
            numeric 只能数数字
        */
        $rule=[
            'title'=>'required',
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
                if (DB::table('picture')->where('id',$id)->update($data)){
                   // 判断旧图片是否存在
                   if (file_exists('./Upload/picture/'.$oldImg)) {
                    // 若存在删除
                        unlink('./Upload/picture/'.$oldImg);
                    }
                    return redirect('admin/picture');
                }else{
                    return back();
                }
            }else{
              // 整理数据
                $data['img']=$request->input('oldImg');
                //修改数据库
                if (DB::table('picture')->where('id',$id)->update($data)) {
                   return redirect('admin/picture');
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
