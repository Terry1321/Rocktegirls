@extends('admin.public.public')
@section('main')

<!-- Uploadifive CSS -->
<link rel="stylesheet" href="{{asset('./uploadifive/uploadifive.css')}}">
<!-- Uploadifive JS -->
<script src="{{asset('./uploadifive/jquery.uploadifive.min.js')}}"></script>

<div class="page-header"><h1>最新资讯添加</h1><small>用于添加最新资讯</small></div>
 <form action="/admin/news" method="post">
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
      <label>标题</label>
      <input type="text" class="form-control" placeholder="请输入标题" name="title" value="{{ old('tilte') }}"> 
    </div>
    <div class="form-group">
      <label>描述</label>
      <input type="text" name="description" class="form-control" placeholder="请输入文章描述" value="{{old('description')}}">
    </div>
    <div class="form-group">
      <label>跳转链接</label>
      <input type="text" name="href" class="form-control" placeholder="请输入跳转链接" value="{{old('href')}}">
    </div>
    <div class="form-group">
      <label>排序</label>
      <input type="number" class="form-control" placeholder="请输入排序" name="sort" value="{{ old('sort')}}"> 
    </div>
    <div class="form-group">
      <label>封面图片</label>
      <input type="file" id="uploads">
      <div class="show"></div>
      <input type="hidden"  class='img' name="img">
    </div>
    <input type="submit" value="提交" class="btn btn-default">
    <a href="/admin/news" class="btn btn-danger">返回</a>
 </form>
 <!-- JAVASCRIPT -->
 <script>

    $(function(){
      // 使用插件
      $('#uploads').uploadifive({
        // 上传按钮的样式（使用插件的样式）
         'buttonText':'请上传封面图片',
         // 传过去的数据
         'formData':{
          // csrf的token值
            '_token':"{{csrf_token()}}",
            // 上传地址
            'file':'./Upload/news',
         },
         // 接口地址
        'uploadScript':'/admin/upload',
        // 成功后
        onUploadComplete:function(flie,data,response){
          // html代码（加号拼接）
          str='<img width="200px" src="/Upload/news/'+data+'" alt="">';
          // html放进class为show的标签
          $('.show').html(str);
          // 放value进img这个div
          $('.img').val(data);
        }
      })
    })
 
 </script>
@endsection