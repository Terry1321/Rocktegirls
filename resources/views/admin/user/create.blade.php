@extends('admin.public.public')
@section('main')
<div class="page-header"><h1>用户管理添加</h1><small>用于添加用户管理</small></div>
 <form action="/admin/user" method="post">
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
    <div class="form-group">
      <label>用户账号（日后不可修改）</label>
      <input type="text" class="form-control" placeholder="请输入账号" name="name" value="{{ old('name') }}"> 
    </div>
    <div class="form-group">
      <label>用户邮箱（日后不可修改）</label>
      <input type="text" class="form-control" placeholder="请输入邮箱" name="email" value="{{ old('email') }}"> 
    </div>
    <div class="form-group">
      <label>用户密码</label>
      <input type="password" class="form-control" placeholder="请输入密码" name="password"> 
    </div>
    <div class="form-group">
      <label>确认密码</label>
      <input type="password" class="form-control" placeholder="请再次输入密码" name="repasswd"> 
    </div>
    <input type="submit" value="提交" class="btn btn-default">
    <a href="/admin/user" class="btn btn-danger">返回</a>
 </form>
@endsection