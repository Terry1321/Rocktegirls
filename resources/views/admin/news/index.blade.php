@extends('admin.public.public')
@section('main')
<div class="page-header">
  <!-- 头部标题 -->
  <h1>最新资讯管理<small>用于控制最新资讯</small></h1>
</div>
  <!-- 面包屑导航 -->
  <ul class="breadcrumb">
      <li><a href="/admin">首页</a></li>
      <li class="active">最新资讯</li>
  </ul>
  <!-- 头部内容 -->
  <div class="row">
    <div class="col-md-7">
      <a href="/admin/news/create" class="btn btn-success pull-left">添加最新资讯</a>
    </div
  </div>
  <!-- 表格 -->
  <table class="table table-bordered table-hover table-condensed">
    <!-- 表头 -->
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">标题</th>
      <th class="text-center">创建时间</th>
      <th class="text-center">跳转链接</th>
      <th class="text-center">图片展示</th>
      <th class="text-center">排序</th>
      <th class="text-center">操作</th>
    </tr>
    @if(isset($data['paginate']))
      @foreach($data['paginate'] as $news)
        <tr class="text-center">
          <!-- id -->
          <td>{{$news->id}}</td>
          <!-- 题目 -->
          <td>{{$news->title}}</td>
          <!-- 创建时间 -->
          <td>{{date('Y-m-d H:i:s',$news->createtime)}}</td>
          <!-- 跳转链接 -->
          <td>{{$news->href}}</td>
          <!-- 图片展示 -->
          <td>
            <img width='100px' src="/Upload/news/{{$news->img}}" alt="">
          </td>
           <!-- 图片排序 -->
          <td>{{$news->sort}}</td>
          <td>
            <a href="/admin/news/{{$news->id}}/edit"><span class="glyphicon glyphicon-cog" style="color:skyblue"></span>修改</a>
            &nbsp;&nbsp;
            <a href="javascript:;" onclick="del(this,{{$news->id}})"><span class="glyphicon glyphicon-trash" style="color: red"></span>删除</a>
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
    // <!-- 最新资讯删除 -->
    function del(obj,id){
      if (confirm('你确定要删除吗？删除后不能被恢复')) {
        $.post('/admin/'+id,{'_method':'delete','_token':'{{csrf_token()}}','table':'news'},function(data){
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