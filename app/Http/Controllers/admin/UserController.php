<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 后台用户管理
class UserController extends Controller
{

	/** 查询数据库数据
		@search 搜索函数
	**/
	public function show($search='查看全部'){
    	// 判断search函数是否存在
    	if ($search=='查看全部') {
			// 总数据
	    	$count=DB::table('user')->count();
    		// 获取全部数据
    		$paginate=DB::table('user')->paginate(15);
    	}else{
    		// 总数值
    		$count=DB::table('user')->where('name','like',"%".$search."%")->count();
			// 获取搜索的数据
    		$paginate=DB::table('user')->where('name','like',"%".$search."%")->paginate(15);
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

    // 用户信息删除
    public function destroy($id){
    	// id如果获取成功
    	if ($id) {
    		// 如果删除成功
    		if (DB::table('user')->where('id',$id)->delete()) {
    			return 1;
    		}else{
    			return 0;
    		}
    	}else{
    		return 0;
    	}
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
			'name'=>'required|unique:user|between:4,12',
			'passwd'=>'required|same:repasswd|between:6,12',
		];
		// 表单验证错误信息
		$message=[
			'name.required'=>'用户名不能为空',
			'name.unique'=>'用户名已存在',
			'name.between'=>'用户名长度不符合规范',
			'passwd.required'=>'密码不能为空',
			'passwd.same'=>'两次密码不相同',
			'passwd.between'=>'密码长度不符合规范',
		];
		// 生成表单验证
		$validator=\Validator::make($data,$rule,$message);
		// 如果通过表单验证
		if ($validator->passes()) {
			// 数据整理
			$data=$request->except('_token','repasswd');
			//密码加密
			$data['passwd']=\Crypt::encrypt($data['passwd']);
			// 默认登陆次数
			$data['count']=0;
			// 创建时间
			$data['createtime']=time();
			// 最后登陆时间
			$data['lasttime']=time();
			// 默认开启
			$data['is_open']=1;
			// 添加数据库
			if (DB::table('user')->insert($data)){
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
	 	$data=DB::table('user')->where('id',$id)->value('name');
	 	// 返回视图和信息
	 	return view('admin.user.edit')->with('data',$data)->with('id',$id);
	 }

	 //用户信息修改操作
	 public function update(Request $request,$id){
	 	// 表单传送过来的数据
		$data=$request->all();
		// 表单验证规则
		$rule=[
			'passwd'=>'required|same:repasswd|between:6,12',
		];
		// 表单验证错误信息
		$message=[
			'passwd.required'=>'密码不能为空',
			'passwd.same'=>'两次密码不相同',
			'passwd.between'=>'密码长度不符合规范',
		];
		// 生成表单验证
		$validator=\Validator::make($data,$rule,$message);
		// 如果通过表单验证
		if ($validator->passes()) {
			// 数据整理
			$data=$request->except('_token','repasswd','_method');
			$data['passwd']=\Crypt::encrypt($data['passwd']);
			// 添加数据库
			if (DB::table('user')->where('id',$id)->update($data)){
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
	 	if (DB::table('user')->where('id',$id)->update(['is_open' => $is_open])) {
	 		return $is_open;
	 	}else{
	 		return 2;
	 	}
	 }
}
