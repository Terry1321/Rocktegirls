@extends('admin.public.public')
@section('main')
<div class="page-header"><h1>后台用户修改</h1><small>用于修改后台用户</small></div>
 <form action="/admin/user/{{$id}}" method="post">
  {{csrf_field()}}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <input type="hidden" name="_method" value="put">
    <div class="form-group">
      <label>用户名</label>
      <input type="text" class="form-control" placeholder="请输入用户名"  value="{{$data}}" disabled="disabled"> 
      <input type="hidden" name="name" value="{{$data}}">
    </div>
    <div class="form-group">
      <label>密码</label>
      <input type="password" class="form-control" placeholder="请输入密码" name="passwd"> 
    </div>
    <div class="form-group">
      <label>请再次输入密码</label>
      <input type="password" class="form-control" placeholder="请再次输入密码" name="repasswd"> 
    </div>
    <input type="submit" value="提交" class="btn btn-default">
    <a href="/admin/user" class="btn btn-danger">返回</a>
 </form>
@endsection