<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\admin\ModelController;
// 轮播图管理控制器
class SliderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
	//轮播图管理首页
    public function index(){
    	/*获取总数*/
    	$count=DB::table('slider')->count();
    	/*获取分页数据*/
    	$paginate=DB::table('slider')->orderBy('sort','asc')->paginate(6);
    	// 整理数据
    	$data=array(
    		"count"=>$count,
    		"paginate"=>$paginate,
    	);
    	/*返回数据给页面*/
    	return view('admin.slider.index')->with('data',$data);
    }

    //轮播图添加页面
    public function create(){
		return view('admin.slider.create');    	
    }

    //轮播图添加操作
    public function store(Request $request){
        // 获取需要验证的数据
        $data=$request->except('_token');  
        /*
            验证规则
            required 不能为空
            numeric 只能数数字
        */
        $rule=[
            'title'=>'required',
            'description'=>'required',
            'sort'=>'required|numeric', 
            'img'=>'required', 
        ];
        /*验证信息*/
        $message=ModelController::message(); 
        //表单验证 
        $validator=\Validator::make($data,$rule,$message);
        // 判断是否通过
        if ($validator->passes()) {
           if (DB::table('slider')->insert($data)) {
                return redirect('admin/slider');
            } else{
                return back();
            }
        }else{
           // 返回错误信息
            return back()->withInput()->withErrors($validator);  
        }
    }

    /*轮播图修改页面*/
    public function edit($id){
        if ($id) {
            // 获取原来的数据
            $data=DB::table('slider')->where('id',$id)->first();
            // 数据整理
            $data->id=$id;
            return view('admin.slider.edit')->with('data',$data);
        }
    }
    
    /*轮播图修改操作*/
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
                if (DB::table('slider')->where('id',$id)->update($data)){
                   // 判断旧图片是否存在
                   if (file_exists('./Upload/Slider/'.$oldImg)) {
                    // 若存在删除
                        unlink('./Upload/Slider/'.$oldImg);
                    }
                    return redirect('admin/slider');
                }else{
                    return back();
                }
            }else{
              // 整理数据
                $data['img']=$request->input('oldImg');
                //修改数据库
                if (DB::table('slider')->where('id',$id)->update($data)) {
                   return redirect('admin/slider');
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
