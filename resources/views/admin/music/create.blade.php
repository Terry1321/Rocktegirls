@extends('admin.public.public')
@section('main')

<!-- Uploadifive CSS -->
<link rel="stylesheet" href="{{asset('./uploadifive/uploadifive.css')}}">
<!-- Uploadifive JS -->
<script src="{{asset('./uploadifive/jquery.uploadifive.min.js')}}"></script>

<div class="page-header"><h1>音乐单曲添加</h1><small>用于添加音乐单曲</small></div>
 <form action="/admin/music" method="post">
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
      <label>音乐单曲title</label>
      <input type="text" class="form-control" placeholder="请输入图片title" name="title" value="{{ old('tilte') }}"> 
    </div>

    <div class="form-group">
      <label>跳转链接</label>
      <input type="text" class="form-control" placeholder="请输入图片title" name="href" value="{{ old('href') }}"> 
    </div>
    <div class="form-group">
      <label>音乐单曲排序</label>
      <input type="number" class="form-control" placeholder="请输入图片排序" name="sort" value="{{ old('sort')}}"> 
    </div>
    <div class="form-group">
      <label>音乐单曲图片</label>
      <input type="file" id="uploads">
      <div class="show"></div>
      <input type="hidden"  class='img' name="img">
    </div>
    <input type="submit" value="提交" class="btn btn-default">
    <a href="/admin/music" class="btn btn-danger">返回</a>
 </form>
 <!-- JAVASCRIPT -->
 <script>
    $(function(){
      // 使用插件
      $('#uploads').uploadifive({
        // 上传按钮的样式（使用插件的样式）
         'buttonText':'请上传音乐单曲',
         // 传过去的数据
         'formData':{
          // csrf的token值
            '_token':"{{csrf_token()}}",
            // 上传地址
            'file':'./Upload/music',
         },
         // 接口地址
        'uploadScript':'/admin/upload',
        // 成功后
        onUploadComplete:function(flie,data,response){
          // html代码（加号拼接）
          str='<img width="200px" src="/Upload/music/'+data+'" alt="">';
          // html放进class为show的标签
          $('.show').html(str);
          // 放value进img这个div
          $('.img').val(data);
        }
      })
    })
 
 </script>
@endsection