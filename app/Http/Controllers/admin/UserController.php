<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\admin\ModelController;
// 后台用户管理
class UserController extends Controller
{
	public function __construct(){
	    $this->middleware('auth');
	}
	/** 查询数据库数据
		@search 搜索函数
	**/
	public function show($search='查看全部'){
    	// 判断search函数是否存在
    	if ($search=='查看全部') {
			// 总数据
	    	$count=DB::table('users')->count();
    		// 获取全部数据
    		$paginate=DB::table('users')->paginate(15);
    	}else{
    		// 总数值
    		$count=DB::table('users')->where('name','like',"%".$search."%")->count();
			// 获取搜索的数据
    		$paginate=DB::table('users')->where('name','like',"%".$search."%")->paginate(15);
    	}
    	// 数据整理
    	$data=array(
    		'paginate'=>$paginate,
    		'count'=>$count,
    	);

    	// 返回数组
    	return $data;
	}

	
    // 后台用户展示
    public function index(){
    	// 调用show函数并获取数据
    	$data=$this->show();
		// 返回数据
    	return view('admin.user.index')->with('data',$data);
    }

	 // 用户搜索
	 public function search(Request $request){
	 	// 获取查询值
	 	$search=$request->input('search');
	 	// 调用show函数并获取数据
	 	$data=$this->show($search);
	 	// 返回数据
    	return view('admin.user.index')->with('data',$data);

	 }

	 //用户添加页面
	 public function create(){
	 	return view('admin.user.create');
	 }

	 // 用户添加操作
	 public function store(Request $request){
	 	// 表单传送过来的数据
		$data=$request->all();
		// 表单验证规则
		$rule=[
			'name'=>'required|unique:users|between:4,12',
			'password'=>'required|same:repasswd|between:6,12',
			'email'=>'required|email|unique:users',
		];
		// 表单验证错误信息
		$message=ModelController::message();
		// 生成表单验证
		$validator=\Validator::make($data,$rule,$message);
		// 如果通过表单验证
		if ($validator->passes()) {
			// 数据整理
			$data=$request->except('_token','repasswd');
			//密码加密
			$data['password']=bcrypt($data['password']);
			// 创建时间
			$data['created_at']=date('Y-m-d H:i:s',time());
			// 默认开启
			$data['is_open']=1;
			// 添加数据库
			if (DB::table('users')->insert($data)){
				return redirect('admin/user');
			}else{
				return back();
			}
		}else{
			// 返回错误信息
			return back()->withInput()->withErrors($validator);	
		}
	 } 

	 //用户信息修改页面
	 public function edit($id){
	 	// 获取对应数据
	 	$data=DB::table('users')->where('id',$id)->first();
	 	// 返回视图和信息
	 	return view('admin.user.edit')->with('data',$data)->with('id',$id);
	 }

	 //用户信息修改操作
	 public function update(Request $request,$id){
	 	// 表单传送过来的数据
		$data=$request->all();
		// 表单验证规则
		$rule=[
			'password'=>'required|same:repasswd|between:6,12',
		];
		// 表单验证错误信息
		$message=ModelController::message();
		// 生成表单验证
		$validator=\Validator::make($data,$rule,$message);
		// 如果通过表单验证
		if ($validator->passes()) {
			// 数据整理
			$data=$request->except('_token','repasswd','_method');
			$data['password']=bcrypt($data['password']);
			// 添加数据库
			if (DB::table('users')->where('id',$id)->update($data)){
				return redirect('admin/user');
			}else{
				return back();
			}
		}else{
			// 返回错误信息
			return back()->withInput()->withErrors($validator);	
		}
	 } 

	 // 用户状态修改
	 public function changeStatu(Request $request,$id){
	 	// 获取状态值
	 	$data=$request->input('is_open');
	 	// 判断修改后的状体值
	 	switch ($data) {
	 		case 1:
	 			$is_open=0;	
	 			break;
	 		
	 		case 0:
	 			$is_open=1;
	 			break;
	 	}
	 	// 修改数据
	 	if (DB::table('users')->where('id',$id)->update(['is_open' => $is_open])) {
	 		return $is_open;
	 	}else{
	 		return 2;
	 	}
	 }
}
