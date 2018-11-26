<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>火箭少女101</title>
	<!-- jquery -->
	<script src="style/home/js/jquery-3.3.1.min.js"></script>
	<!-- bootstrap -->
	<link rel="stylesheet" href="bs/css/bootstrap.min.css">
	<script src='bs/js/bootstrap.min.js'></script>
	<!-- index.css -->
	<link rel="stylesheet" href="style/home/css/index.css">
	<!-- swiper -->
	 <script src="style/home/js/swiper.min.js"></script>
	  <link rel="stylesheet" href="style/home/css/swiper.min.css"> 
</head>
<style>	
	a:hover{
		text-decoration: none;
	}

</style>
<body>
	<div class="container-fluid">
		<!-- 头部logo -->
		<div class="row">
			<div class="col-md-12 text-center">
				<a href="index.html" ><img src="style/home/image/logo.png" width="220" alt="logo" title="火箭少女101"></a>
			</div>
		</div>
		<!-- 顶部轮播图 -->
		<div class="row">
			<div class="col-md-12">
				<div id="myCarousel" class="carousel slide">
				    <!-- 轮播（Carousel）指标 -->
				    <!-- 定义两个变量用于命名 -->
				    <?php 
				    	$i=0;//用轮播图点的命名
				    	$j=0;//用于轮播图图片命名
				     ?>
				    <ol class="carousel-indicators">
				    	<!--遍历从后台传过来的轮播图数据 -->
				    	@foreach($data['slider'] as $slider)
				    	<!-- i++ 先使用后赋值 -->
							<?php $i++ ?>			    	
				            <li data-target="#myCarousel" data-slide-to="{{$i}}" id="id_{{$i}}"></li>
					      @endforeach  
				    </ol>

				    <!-- 轮播（Carousel）项目 -->
				    <div class="carousel-inner">
			    	@foreach($data['slider'] as $slider)
			    	<!-- j++ 先使用后赋值 -->
						<?php $j++ ?>	
				       	<div class="item" id="img_{{$j}}"><img src="/Upload/slider/{{$slider->img}}" title="{{$slider->title}}" ></div>
			       	  @endforeach 
				   <script>
				   	//为上方两个div添加对应的类
						$('#id_1').addClass('active');
						$('#img_1').addClass('active');
				    </script>
				    </div>

				    <!-- 轮播（Carousel）导航 -->
				        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				            <span class="sr-only">Previous</span>
				        </a>
				        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				            <span class="sr-only">Next</span>
				        </a>
				</div> 
			</div>
		</div>
		<!--最新资讯和微博互动 -->
		<div class="row news">
			<!-- 最新资讯 -->
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<div class="pull-right">
					<div class="panel panel-default">
						<div class="panel-heading">
							最新资讯
							<div class="pull-right">
								{{$data['news']->links()}}
							</div>								
						</div>
						<ul class="list-group">
							@foreach($data['news'] as $news)
							<a href="{{$news->href}}" target="_blank">
								<li class="list-group-item">
									<div class="media">
									<div class="media-left">
										<img src="/Upload/news/{{$news->img}}" title='{{$news->title}}' class="media-object">
									</div>
									<div class="media-body">
										<h4 class="media-heading" style="color: black">{{$news->title}}</h4><small class="pull-right">{{date('m-d',$news->createtime)}}</small>
										<p class="news-info" style="color: black">{{$news->description}}</p>
									</div>
								</div>
								</li>
							</a>
							@endforeach
						</ul>
					</div>
				</div>
			</div>

			<!-- 微博互动 -->
			<div class="col-md-5">
				<div class="pull-left">
					<div class="panel panel-default">
						<div class="panel-heading">微博互动</div>
						<ul class="list-group">
							  <iframe id="weiboScollBox" width="830" height="665" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=830&height=665&fansRow=2&ptype=1&speed=0&skin=5&isTitle=0&noborder=0&isWeibo=1&isFans=0&uid=5281360151&verifier=b8ff8efa&dpc=1"></iframe>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>

		<!-- 成员介绍 -->
		<div class="row member">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="title text-center"><strong>成员介绍</strong></div>
				<div class="body">
				<!-- Swiper -->
					<div class="swiper-container gallery-thumbs">
						<div class="swiper-wrapper">
							@foreach($data['member'] as $member)
						  <div class="swiper-slide" title='{{$member->title}}' style="background-image:url(/Upload/member/{{$member->img}})">
							<div class="col-md-12" style="height: 80%"></div>
							<div class="col-md-12 name text-center">{{$member->name}}</div>
						  </div>
						  @endforeach
						</div>
					</div>
					<div class="swiper-container gallery-top">
						<div class="swiper-wrapper">
							@foreach($data['member'] as $member)
						  <div class="swiper-slide">
						  	<div class="media">
								<div class="media-left media-top">
									<img src="/Upload/member/{{$member->img}}" title='{{$member->title}}' class="media-object">
								</div>
								<div class="media-body">
									<h1 class="media-heading ">{{$member->name}}</h1>
									<p>{{$member->title}}</p>
									<p>{{$member->description}}</p>
								</div>
							</div>
						  </div>
						   @endforeach
					   </div>	
					  </div>
				     </div>
				</div>
			</div>
		<!-- 音乐作品-->
		<div class="row music">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="title text-center">
					<strong>最新单曲</strong>
				</div>
				<div class="music-body">
					<div id="certify">
						<div class="swiper-container music-container">
							<div class="swiper-wrapper">
								@foreach($data['music'] as $music)
								<a href='{{$music->href}}' target='_blank' title="{{$music->title}}" class="swiper-slide" style="background: url('/Upload/music/{{$music->img}}') no-repeat;background-size:100%"></a>
								@endforeach
							</div>
						</div>
						<div class="swiper-pagination"></div>
				     </div>	
					</div>
					</div>
					
				</div>
			<!-- 热门视频 -->
		</div>
		<div class="row video">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="title text-center"><strong>热门视频</strong></div>
				<div class="video-body">
					<div class="container-fluid">
						@foreach($data['video'] as $firstRow)
						<div class="row">
							@foreach($firstRow as $video)
						    <div class="col-sm-3 col-md-3">
						         <div class="thumbnail">
						         	<div class="portfolio-item portfolio-effect__item portfolio-item--eff1">
							            <img src="/Upload/video/{{$video->img}}" title="{{$video->title}}" 
							             alt="通用的占位符缩略图">
							             <a href="" target='_blank'>
								          <div class="portfolio-item__info">
								            <img src="style/home/image/start.jpg" width="" alt="">
								          </div>
						            	</a>
						         	</div>
						            <div class="caption">
						            	<a href="{{$video->href}}" target='_blank' style="color: black"><p class="video-info">{{$video->title}}</p></a>
						               <a href="{{$video->href}}" target='_blank' style="color: black"><p class="video-info">{{$video->description}}</p></a>
						            </div>
						         </div>
						    </div>
						    @endforeach
						</div>
						@endforeach
						</div>
					</div>
		     	</div>
			</div>
		</div>
			<!--图片花絮  -->
			<div class="row picture">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="title text-center"><strong>图片花絮</strong></div>
					<div class="picture-body">
					<div class="container-fluid">
						@foreach($data['picture'] as $row)
						<div class="row">
							@foreach($row as $picture)
						    <div class="col-sm-3 col-md-3">
						        <div class="thumbnail margin">
						            <img src="Upload/picture/{{$picture->img}}" title='{{$picture->title}}'
						                 alt="火箭少女101图片花絮" data-toggle="modal" data-target="#myModal{{$picture->id}}">
						        </div>
						    </div>
						    @endforeach
						</div>
						@endforeach
					</div>
	
				</div>
			</div>
			<!-- 模态框 -->
		@foreach($data['picture'] as $row)
			@foreach($row as $picture)
				<div class="modal fade" id="myModal{{$picture->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
							</div>
							<div class="modal-body">
								<img src="/Upload/picture/{{$picture->img}}" alt="" width="100%">
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal -->
				</div>
			@endforeach
		@endforeach
	</div>
</body>
<script>
	   //  控制轮播图速度
		$(function(){
			$('#myCarousel').carousel({
		    interval: 2000	
		})
 });
	/*
	*	swiper插件
	*	成员介绍
	*/
	 var galleryThumbs = new Swiper('.gallery-thumbs', {
	      spaceBetween: 10,
	      slidesPerView: 6,
	      freeMode: true,
	      watchSlidesVisibility: true,
	      watchSlidesProgress: true,
	    });
	    var galleryTop = new Swiper('.gallery-top', {
	      spaceBetween: 20,
	      thumbs: {
	        swiper: galleryThumbs
	      }
	    });	
	/*
	*	swiper插件
	*	最新单曲
	*/

var certifySwiper = new Swiper('#certify .swiper-container', {
 	watchSlidesVisibility: true,
	watchSlidesProgress: true,
	slidesPerView: 'auto',
	centeredSlides: true,
	loop: true,
	// loopedSlides: 7,
	// autoplay: true,
	navigation: {
		nextEl: '.next1',
		prevEl: '.prev1',
	},
	pagination: {
		el: '.swiper-pagination',
	},
	on: {
		progress: function(progress) {
			for (i = 0; i < this.slides.length; i++) {
				var slide = this.slides.eq(i);
				var slideProgress = this.slides[i].progress;
				modify = 1;
				if (Math.abs(slideProgress) > 1) {
					modify = (Math.abs(slideProgress) - 1) * 0.4 + 1;
				}
				translate = slideProgress * modify * 120 + 'px';
				scale = 1 - Math.abs(slideProgress) / 5;
				zIndex = 999 - Math.abs(Math.round(10 * slideProgress));
				slide.transform('translateX(' + translate + ') scale(' + scale + ')');
				slide.css('zIndex', zIndex);
				slide.css('opacity', 1);
				if (Math.abs(slideProgress) > 3) {
					slide.css('opacity', 0);
				}
			}
		},
		setTransition: function(transition) {
			for (var i = 0; i < this.slides.length; i++) {
				var slide = this.slides.eq(i)
				slide.transition(transition);
			}

		}
	}

})
</script>
</html>