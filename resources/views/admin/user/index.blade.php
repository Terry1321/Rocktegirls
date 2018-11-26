@extends('admin.public.public')
@section('main')
<div class="page-header">
  <!-- 头部标题 -->
  <h1>用户管理<small>用于控制后台登陆用户</small></h1>
</div>
  <!-- 面包屑导航 -->
  <ul class="breadcrumb">
      <li><a href="/admin">首页</a></li>
      <li class="active">用户</li>
  </ul>
  <!-- 头部内容 -->
  <div class="row">
    <div class="col-md-7">
      <a href="/admin/user/create" class="btn btn-success pull-left">添加用户</a>
    </div>
    <!-- 用户查询 -->
  <form action="/admin/user/search" method="post">
    {{csrf_field()}}
    <div class="col-md-5">
      <div class="row">
        <div class="col-md-9" style="padding-right: 0">
          <input type="search" name="search" class="form-control" placeholder="输入用户名查询">
        </div>
        <div class="col-md-1" style="padding-left: 0">
          <input type="submit" value="搜索" class="btn btn-default">
        </div>
        <div class="col-md-1">
           <a href="/admin/user" class="btn btn-default">取消</a>
        </div>
      </div>
    </div>
  </form>
  </div>
  <!-- 表格 -->
  <table class="table table-bordered table-hover table-condensed">
    <!-- 表头 -->
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">用户名</th>
      <th class="text-center">邮箱</th>
      <th class="text-center">用户是否可用</th>
      <th class="text-center">用户创建时间</th>
      <th class="text-center">操作</th>
    </tr>
    @if(isset($data['paginate']))
      @foreach($data['paginate'] as $userInfo)
        <tr class="text-center">
          <!-- 用户id -->
          <td>{{$userInfo->id}}</td>
          <!-- 用户名字 -->
          <td>{{$userInfo->name}}</td>
          <!-- 用户登陆邮箱 -->
          <td>{{$userInfo->email}}</td>
          <!-- 判断用户状态 -->
          @if($userInfo->is_open)
            <td><span class="btn btn-success" id='statu' onclick="changeStatu(this,{{$userInfo->id}},{{$userInfo->is_open}})">可用</span></td>
          @else
            <td><span class="btn btn-danger" id='statu' onclick="changeStatu(this,{{$userInfo->id}},{{$userInfo->is_open}})">禁用</span></td>
          @endif
          <!-- 创建时间 -->
          <td>{{$userInfo->created_at}}</td>
          <td>
            <a href="/admin/user/{{$userInfo->id}}/edit"><span class="glyphicon glyphicon-cog" style="color:skyblue"></span>修改</a>
            &nbsp;&nbsp;
            <a href="javascript:;" onclick="del(this,{{$userInfo->id}})"><span class="glyphicon glyphicon-trash" style="color: red"></span>删除</a>
          </td>
        </tr>
        @endforeach
    @endif
    <!-- 内容 -->
  
  </table>
  <!-- 分页 -->
  <div class="page-header">
    <div class="count pull-right">共<span class="num">{{$data['count']}}</span>条数据</div>
    {{ $data['paginate']->links()}}
  </div>
  <script>
    // <!-- 用户删除 -->
    function del(obj,id){
      if (confirm('你确定要删除吗？删除后不能被恢复')) {
        $.post('/admin/'+id,{'_method':'delete','_token':'{{csrf_token()}}','table':'users'},function(data){
          if (data) {
            // 删除列表
            $(obj).parent().parent().remove();
            // 获取总数
            count=Number($('.num').html());
            // 计算删除后的总数
            $('.num').html(--count);
          }else{
            alert('删除失败请刷新重试');
          }
        });
      }
    }
    // 用户状态修改
    function changeStatu(obj,id,statu){
      if (confirm('确认修改用户状态吗？')) {
        $.post('/admin/user/changestatu/'+id,{'is_open':statu,'_token':'{{csrf_token()}}'},function(res){
          if (res==1) {
            $(obj).parent().html("<span class='btn btn-success' id='statu' onclick='changeStatu(this,"+id+",1)'>可用</span>");
          }else if(res==0){
            $(obj).parent().html("<span class='btn btn-danger' id='statu' onclick='changeStatu(this,"+id+",0)'>禁用</span>");
          }else{
            alert('修改失败，请刷新页面');
          }
        });
      }
    }
  </script>
@endsection