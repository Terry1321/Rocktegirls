@extends('admin.public.public')
@section('main')
<div class="page-header">
  <!-- 头部标题 -->
  <h1>图片花絮管理<small>用于控制图片花絮</small></h1>
</div>
  <!-- 面包屑导航 -->
  <ul class="breadcrumb">
      <li><a href="/admin">首页</a></li>
      <li class="active">图片花絮</li>
  </ul>
  <!-- 头部内容 -->
  <div class="row">
    <div class="col-md-7">
      <a href="/admin/picture/create" class="btn btn-success pull-left">添加图片花絮</a>
    </div>
  </div>
  <!-- 表格 -->
  <table class="table table-bordered table-hover table-condensed">
    <!-- 表头 -->
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">title</th>
      <th class="text-center">图片展示</th>
      <th class="text-center">排序</th>
      <th class="text-center">操作</th>
    </tr>
    @if(isset($data['paginate']))
      @foreach($data['paginate'] as $picture)
        <tr class="text-center">
          <!-- 图片id -->
          <td>{{$picture->id}}</td>
          <!-- 图片title -->
          <td>{{$picture->title}}</td>
          <!-- 图片展示 -->
          <td>
            <img width='100px'  src="/Upload/picture/{{$picture->img}}" alt="">
          </td>
           <!-- 图片排序 -->
          <td>{{$picture->sort}}</td>
          <td>
            <a href="/admin/picture/{{$picture->id}}/edit"><span class="glyphicon glyphicon-cog" style="color:skyblue"></span>修改</a>
            &nbsp;&nbsp;
            <a href="javascript:;" onclick="del(this,{{$picture->id}})"><span class="glyphicon glyphicon-trash" style="color: red"></span>删除</a>
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
    // <!-- 图片花絮删除 -->
    function del(obj,id){
      if (confirm('你确定要删除吗？删除后不能被恢复')) {
        $.post('/admin/'+id,{'_method':'delete','_token':'{{csrf_token()}}','table':'picture'},function(data){
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
  </script>
@endsection