<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
  <!-- Bootrstrap CSS -->
  <link rel="stylesheet" href="../../bs/css/bootstrap.min.css">
  <!-- Swiper JS -->
	<link rel="stylesheet" href="../../style/home/css/swiper.min.css">
  <!-- index -->
	<link rel="stylesheet" href="../../style/admin/css/index.css">
	<!-- Swiper JS -->
	<script src="../../style/home/js/swiper.min.js"></script>
<body>
	<!-- Swiper -->
	<div class="swiper-container">
		<div class="swiper-wrapper">
      <!-- 左侧菜单栏 -->
			<div class="swiper-slide menu">
        <ul class="list-unstyled">
          <li class="list text-center">火箭少女101后台首页</li>
          <a href="index.html"><li class="list text-center"><span class="glyphicon glyphicon-th"></span>&nbsp;后台首页</li></a>
          <a href="index.html"><li class="list text-center"><span class="glyphicon glyphicon-user"></span>&nbsp;用户管理</li></a>
          <a href="slider.html"><li class="list text-center"><span class="glyphicon glyphicon-indent-right"></span>&nbsp;轮播图片</li></a>
          <a href="music.html"><li class="list text-center list-active"><span class="glyphicon glyphicon-music"></span>&nbsp;音乐单曲</li></a>
          <a href="video.html"><li class="list text-center"><span class="glyphicon glyphicon-film"></span>&nbsp;热门视频</li></a>
          <a href="picture.html"><li class="list text-center"><span class="glyphicon glyphicon-picture"></span>&nbsp;图片花絮</li></a>
          <a href="clear.html"><li class="list text-center"><span class="glyphicon glyphicon-trash"></span>&nbsp;清理缓存</li></a>
          <a href="logout.html"><li class="list text-center"><span class="glyphicon glyphicon-off"></span>&nbsp;退出账号</li></a>
        </ul>
      </div>
      <!-- 内容 -->
			<div class="swiper-slide content">
        <!-- 按钮 -->
				<div class="menu-button">
					<div class="bar"></div>
					<div class="bar"></div>
					<div class="bar"></div>
				</div>
        <!-- 主内容 -->
  			<div class="container">
        <div class="page-header">
          <!-- 头部标题 -->
          <h1>音乐单曲管理<small>用于控制首页音乐单曲板块</small></h1>
        </div>
          <!-- 面包屑导航 -->
          <ul class="breadcrumb">
              <li><a href="#">首页</a></li>
              <li class="active">音乐单曲</li>
          </ul>
          <a href="" class="btn btn-success pull-left">添加音乐</a>
          <div class="count pull-right">共<span class="num">1</span>条数据</div>
          <table class="table table-bordered table-hover table-condensed">
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">排序</th>
              <th class="text-center">标题</th>
              <th class="text-center">图片</th>
              <th class="text-center">操作</th>
            </tr>
            <tr class="text-center">
              <td vertical-align='middle'>1</td>
              <td>1</td>
              <td>音乐单曲1</td>
              <td><img width='100px' src="../../style/home/image/logo.png" alt=""></td>
              <td>
                <a href=""><span class="glyphicon glyphicon-cog" style="color:skyblue"></span>修改</a>
                &nbsp;&nbsp;
                <a href=""><span class="glyphicon glyphicon-trash" style="color: red"></span>删除</a>
              </td>
            </tr>
          </table>
        </div>
        <!-- 主内容结束 -->
			</div>
		</div>
	</div>
  <!-- Swiper -->
	<script>
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
	</script>
</body>
</html>