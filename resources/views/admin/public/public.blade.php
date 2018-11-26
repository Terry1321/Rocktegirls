<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
  <!-- Jquery -->
  <script src="{{asset('./style/home/js/jquery-3.3.1.min.js')}}"></script>
  <!-- Bootrstrap CSS -->
  <link rel="stylesheet" href='{{asset("./bs/css/bootstrap.min.css")}}'>
  <!-- Swiper JS -->
	<link rel="stylesheet" href='{{asset("./style/home/css/swiper.min.css")}}'>
  <!-- index -->
	<link rel="stylesheet" href="{{asset('./style/admin/css/index.css')}}">
	<!-- Swiper JS -->
	<script src="{{asset('./style/home/js/swiper.min.js')}}"></script>
<body>
	<!-- Swiper -->
	<div class="swiper-container">
		<div class="swiper-wrapper">
      <!-- 左侧菜单栏 -->
			<div class="swiper-slide menu">
        <ul class="list-unstyled">
          <li class="list text-center">火箭少女101后台首页</li>
          <a href="/admin"><li class="list text-center" id="admin"><span class="glyphicon glyphicon-home"></span>&nbsp;后台首页</li></a>
          <a href="/admin/user"><li class="list text-center" id="user"><span class="glyphicon glyphicon-user"></span>&nbsp;用户管理</li></a>
          <a href="/admin/member"><li class="list text-center" id="member"><span class="glyphicon glyphicon-heart"></span>&nbsp;成员介绍</li></a>
          <a href="/admin/news"><li class="list text-center news" id="news"><span class="glyphicon glyphicon-file"></span>&nbsp;最新资讯</li></a>
          <a href="/admin/slider"><li class="list text-center slider" id="slider"><span class="glyphicon glyphicon-indent-right"></span>&nbsp;轮播图片</li></a>
          <a href="/admin/music"><li class="list text-center music" id="music"><span class="glyphicon glyphicon-music"></span>&nbsp;音乐单曲</li></a>
          <a href="/admin/video"><li class="list text-center video" id="video"><span class="glyphicon glyphicon-film"></span>&nbsp;热门视频</li></a>
          <a href="/admin/picture"><li class="list text-center picture" id="picture"><span class="glyphicon glyphicon-picture"></span>&nbsp;图片花絮</li></a>
          <a href="javascript:;" id='clear'><li class="list text-center"><span class="glyphicon glyphicon-trash"></span>&nbsp;清理缓存</li></a>
           <a href="{{ route('logout') }}"onclick="if (confirm('你确定要退出吗?')) {event.preventDefault(); document.getElementById('logout-form').submit();}">
              <li class="list text-center"><span class="glyphicon glyphicon-off"></span>&nbsp;退出账号</li>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </ul>
      </div>
      <!-- 内容 -->
			<div class="swiper-slide content" >
        <!-- 按钮 -->
				<div class="menu-button">
					<div class="bar"></div>
					<div class="bar"></div>
					<div class="bar"></div>
				</div>
        <!-- 主内容 -->
  			<div class="container">
          @yield('main')
        </div>
        <!-- 主内容结束 -->
			</div>
		</div>
	</div>
  <!-- Swiper -->
	<script>
    // 清理缓存
    $('#clear').click(function(){
      if (confirm('你确定要清理吗?')) {}
      $.get('admin/clearcache',{},function(data){
          if(data){
            alert('清理成功');
          }else{
            alert('清理失败,刷新重试');
          }
      })
    });
    var menuButton = document.querySelector('.menu-button');
    // 启动Swiper
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 'auto',
      initialSlide: 1,
      resistanceRatio: 0,
      slideToClickedSlide: true,
      // 实现拖拽效果
      on: {
        init: function () {
          var slider = this;
          menuButton.addEventListener('click', function () {
            if (slider.activeIndex === 0) {
              slider.slideNext();
            } else {
              slider.slidePrev();
            }
          }, true);
        },
        // 改变按钮样子
        slideChange: function () {
          var slider = this;
          if (slider.activeIndex === 0) {
            menuButton.classList.add('cross');
          } else {
            menuButton.classList.remove('cross');
          }
        },
      }
    });

// 添加cative
    <?php 
      $arr=explode('/', $_SERVER['REDIRECT_URL']);
      $active=isset($arr[2])?$arr[2]:$arr[1];
     ?>
    $('#{{$active}}').addClass('list-active');

	</script>
</body>
</html>