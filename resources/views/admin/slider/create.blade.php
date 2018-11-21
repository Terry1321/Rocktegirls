@extends('admin.public.public')
@section('main')
<div class="page-header"><h1>轮播图添加</h1><small>用于添加轮播图</small></div>
 <form action="/admin/slider" method="post">
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
    <div class="form-group" >
      <label>轮播图title</label>
      <input type="text" class="form-control" placeholder="请输入图片title" name="title" value="{{ old('tilte') }}"> 
    </div>
    <div class="form-group">
      <label>轮播图描述</label>
      <input type="text" class="form-control" placeholder="请输入图片描述" name="description" value="{{ old('descriptopm')}}"> 
    </div>
    <div class="form-group">
      <label>轮播图排序</label>
      <input type="number" class="form-control" placeholder="请输入图片排序" name="sort" value="{{ old('sort') }}”> 
    </div>
    <div class="form-group">
      <label>轮播图图片</label>
      <input type="file" id="slider" >
    </div>
    <input type="submit" value="提交" class="btn btn-default">
    <a href="/admin/slider" class="btn btn-danger">返回</a>
 </form>
@endsection