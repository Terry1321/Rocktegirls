<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// Model
class ModelController extends Controller
{
  public function __construct(){
        $this->middleware('auth');
    }
    //图片上传函数
    public function upload(Request $request){
        // 接收将要保存的路径
        $path=$request->input('file');
        // 获取图片信息
        $imgData=$request->file('Filedata');
        // 判断文件夹是否存在
        if (!file_exists($path)) {
            // 创建文件夹
            mkdir($path,0777,true);
        }
        //判断图片是否存在 
        if (isset($imgData)&&file_exists($path)) {
            // 获取图片后缀
            $ext=$imgData->getClientOriginalExtension();
            // 图片新名字，以免重复覆盖
            $newName=time().rand().rand().'.'.$ext;
            // 把图片移动至对应目录
            if($imgData->move($path, $newName)){
                return $newName;
            }
        }
    }

    // 数据删除函数
    public function destory($id,Request $request){
        // 获取需要删除的表格
        $table=$request->input('table');
        // 查询数据库数据是否有图片
        $data=DB::table($table)->where('id',$id)->first();
         // 判断是否有图片以及图片是否存在
        if (isset($data->img)&&file_exists('./Upload/'.$table.'/'.$data->img)) {
            // 删除图片
           unlink('./Upload/'.$table.'/'.$data->img);
        }
            // 如果删除成功
        if (DB::table($table)->where('id',$id)->delete()) {
            return 1;
        }else{
            return 0;
        }
    }
// 验证信息
    public static  function message(){
        $message=array(
            'name.required'=>'用户名不能为空',
            'name.unique'=>'用户名已存在',
            'name.between'=>'用户名长度不符合规范',
            'password.required'=>'密码不能为空',
            'password.same'=>'两次密码不相同',
            'password.between'=>'密码长度不符合规范',
            'img.required'=>'请上传图片',
            'title.required'=>'title不能为空',
            'description.required'=>'description不能为空',
            'sort.required'=>'排序不能为空', 
            'sort.numeric'=>'排序只能是数字',
            'href.url'=>'必须是有效跳转链接',
            'href.required'=>'跳转链接不能为空',
            'content.required'=>'文章内容不能为空',
            'email.email'=>'请输入正确邮箱',
            'email.required'=>'请输入邮箱',
            'email.uniqid'=>'邮箱已存在',
        );
        return $message;
    }
// 清理缓存方法
     public function clear($path){
         if (is_dir($path)) {
             $data=scandir($path);
             foreach ($data as $value) {
                 $paths=$path.'/'.$value;
                 if ($value!='.'&&$value!='..') {
                     if (is_dir($paths)) {
                         $this->clear($paths);
                     }else{
                         unlink($paths);
                     }
                 }
             }
          if($path!='../storage/framework/cache'&&$path!='../storage/framework/views'){
                 rmdir($path);
          }
             return "删除成功";
         }else{
             return 0;
         }
     }

 // 执行清理缓存
     public function clearCache(){
         $this->clear('../storage/framework/cache');
         $this->clear('../storage/framework/views');
         return 1;
     } 
}
