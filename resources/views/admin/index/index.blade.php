@extends('admin.public.public')
@section('main')
<h1 class="page-header">欢迎进入火箭少女101后台</h1>
<div class="jumbotron">
  <div class="container">
    <p>早上好，{{ Auth::user()->name }}</p>
    <strong>鼠标向右拖拽打开菜单栏，开始管理你的网站吧！</strong>
    <p></p><!-- 占行 -->
    <p><a href="/"><span class="glyphicon glyphicon-home">点击我返回首页</span></a></p>
  </div>
</div>
@endsection