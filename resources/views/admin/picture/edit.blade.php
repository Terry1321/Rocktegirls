@extends('admin.public.public')
@section('main')

<!-- Uploadifive CSS -->
<link rel="stylesheet" href="{{asset('./uploadifive/uploadifive.css')}}">
<!-- Uploadifive JS -->
<script src="{{asset('./uploadifive/jquery.uploadifive.min.js')}}"></script>

<div class="page-header"><h1>图片花絮修改</h1><small>用于修改图片花絮</small></div>
 <form action="/admin/picture/{{$data->id}}" method="post">
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
      <label>图片花絮title</label>
      <input type="text" class="form-control" placeholder="请输入图片title" name="title" value="{{$data->title}}"> 
    </div>
    <div class="form-group">
      <label>图片花絮排序</label>
      <input type="number" class="form-control" placeholder="请输入图片排序" name="sort" value="{{$data->sort}}"> 
    </div>
    <div class="form-group">
      <label>原图</label>
      <div>
        <img width="200px" src="/Upload/picture/{{$data->img}}" alt="">
      </div>
      <input type="hidden" name="oldImg" value="{{$data->img}}">
    </div>
    <div class="form-group">
      <label>图片花絮图片</label>
      <input type="file" id="uploads">
      <div class="show"></div>
      <input type="hidden"  class='img' name="img">
    </div>
    <input type="submit" value="提交" class="btn btn-default">
    <a href="/admin/picture" class="btn btn-danger">返回</a>
 </form>
 <!-- JAVASCRIPT -->
 <script>
    $(function(){
      // 使用插件
      $('#uploads').uploadifive({
        // 上传按钮的样式（使用插件的样式）
         'buttonText':'请上传图片',
         // 传过去的数据
         'formData':{
          // csrf的token值
            '_token':"{{csrf_token()}}",
            // 上传地址
            'file':'./Upload/picture',
         },
         // 接口地址
        'uploadScript':'/admin/upload',
        // 成功后
        onUploadComplete:function(flie,data,response){
          // html代码（加号拼接）
          str='<img width="200px" src="/Upload/picture/'+data+'" alt="">';
          // html放进class为show的标签
          $('.show').html(str);
          // 放value进img这个div
          $('.img').val(data);
        }
      })
    })
 
 </script>
@endsection