<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>{{$webTitle}} - 博客列表</title>
<link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Ladies Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="{{ URL::asset('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('css/flexslider.css') }}" type="text/css" media="screen" />
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<link href="{{ URL::asset('css/swipebox.css') }}" rel="stylesheet" type="text/css"/>
 <!------ Light Box ------>
    <script src="{{ URL::asset('js/jquery.swipebox.min.js') }}"></script> 
    <script type="text/javascript">
		jQuery(function($) {
			$(".swipebox").swipebox();
		});
	</script>
    <!------ Eng Light Box ------>
	<script src="{{ URL::asset('js/responsiveslides.min.js') }}"></script>
	<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>

</head>
<body>
	<div class="header">
		<div class="container">
			<!-- logo和个人信息栏 -->
			<div class="logo">
				<a href="{{url ('index')}}"><img src="{{ URL::asset('images/logo.png') }}" class="img-responsive" alt=""></a>
				<div class="user">
				@if (!empty(session('uid')))
					<table >
					<tr>
						<td rowspan="2"><img src="{{session('pic')}}" width="50px" height="50px" /></td>
						<td width="10px"></td>
						<td>{{session('username')}}</td>
					</tr>
					<tr>
						<td width="10px"></td>
						<td><a href="{{url ('user/user/logout')}}">退出登录</a></td>
					</tr>
					</table>
				@endif
				</div>
			</div>
			<!-- 完成-logo和个人信息栏 -->
			<!-- 目录栏与搜索栏 -->
			<div class="header-bottom">
				<div class="head-nav">
					<span class="menu"> </span>
						<ul class="cl-effect-3">
							<li><a href="{{url ('index')}}">首页</a></li>
							<li class="active"><a href="{{url ('blog')}}">博客</a></li>
							@if (empty(session('username')))
							<li><a href="{{url ('user/user')}}">登录</a></li>
							@else
							<li><a href="{{url ('user/info')}}">个人资料</a></li>
								@if (session('undertype') == 1)
								<li><a href="{{url ('send')}}">发表</a></li>
								<li><a href="{{url ('admin')}}">管理</a></li>
								@endif
							@endif
								<div class="clearfix"></div>
						</ul>
				</div>
				<!-- script-for-nav -->
					<script>
						$( "span.menu" ).click(function() {
						  $( ".head-nav ul" ).slideToggle(300, function() {
							// Animation complete.
						  });
						});
					</script>
				<!-- script-for-nav -->

				<div class="search2">
					<form method = "get" action = "{{url ('search')}}" id="searchForm">
						<input type="text" id="searchStr" name = "searchStr" placeholder = "Search.."  onfocus="if (this.value == '' || this.value == 'Search..') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search..';}">
						<input type="submit" value="" onclick="search_btn()">
						<script type="text/javascript">
							function search_btn()
							{
								$('#searchForm').attr('onsubmit' , '');
								if ($('#searchStr').val().length == 0) {
									alert('搜索内容不得为空');
									$('#searchForm').attr('onsubmit' , 'return false');
									return false;
								}
							}
						</script>
					</form>
				</div>
					<div class="clearfix"></div>
			</div>
			<!-- 完成-目录栏与搜索栏 -->
		</div>
	</div>
<!-- 博客展示列表 -->
	<div class="main">
		<div class="container">
			<div class="content">	 	 
		 		<div class="section group">
					<div class="col-md-9 cont span_2_of_3">
					@foreach ($details as $vdetails)
						<div class="blog_grid">
							<h2 class="post_title"><a href="{{url ('single/' . $vdetails->id)}}">{{$vdetails->title}}</a></h2>
							<a href="{{url ('single/' . $vdetails->id)}}"><img src="{{$vdetails->path}}" class="img-responsive" alt="" /></a>
							<p class = "blog">{{$vdetails->content}}</p>
								<div class="button1"><a class="more" href="{{url ('single/' . $vdetails->id)}}"><i>开始阅读</i></a></div>
							<ul class="links">
								<li><i class="date"> </i><span class="icon_text">{{ date('Y-m-d H:i:s' , $vdetails->addtime)}}</span></li>
								<li><i class="admin"> </i><span class="icon_text">{{$author}}</span></li>
								<li><i class="comments"> </i><span class="icon_text">{{$vdetails->replycount}} 回复</span></li>
								<li><i class="views"> </i><span class="icon_text">{{$vdetails->hits}} 浏览</span></li>
							</ul>
						</div>
					@endforeach
						<!-- 分页 -->
						<div class="pagination pagination__posts">
							{!! $details->links() !!}
						</div>
						<!-- 完成-分页 -->
					</div>
					<!-- 侧边栏 -->
					<div class="col-md-3 rsidebar span_1_of_3 services_list">
						<ul class="archive-list">
							<h3>Note . Rember</h3>
							<li>Remeber , no russia</li>
							<li>请患者不要死在走廊上</li>
							<li>飞来的子弹有优先通行权</li> 
							<li>The cake is a lie</li>
							<li>万物皆虚，万物皆允</li>	
							<li>永远不要在敌人犯错误的时候打断他们</li>	                 
							<li>War , war never changes</li>	                 
					  </ul>				
					</div>
					<!-- 完成-侧边栏 -->
					<div class="clearfix"></div>					  
				</div>
			</div>
		</div>
	</div>
<!-- 完成-博客展示列表 -->
<!-- 底栏 -->
<div class="footer">
	<div class="container">
		<div class="col-md-4 social">
			<h4>友情链接</h4>
			<ul>
				@foreach ($link as $vlink)
					<li>
						<a href="{{$vlink->url}}">{{$vlink->name}}</a>
						<br />
						"——{{$vlink->description}}"
					</li>
					<!-- <div class="clearfix"></div>	 -->
				@endforeach
			</ul>
		</div>
		<div class="col-md-4 information">
			<h4>网站介绍</h4>
			<p>{{$webInfo}}</p>
		</div>
		<div class="col-md-4 searby">
			<h4>快速搜索</h4>
			<div class="col-md-6 by1">
				<li><a href="{{ url ('search?searchStr=帖子')}}">帖子</a></li>
				<li><a href="{{ url ('search?searchStr=侠盗飞车5')}}">侠盗飞车5 </a></li>
				<li><a href="{{ url ('search?searchStr=刺客信条')}}">刺客信条</a></li>
				<li><a href="{{ url ('search?searchStr=彩虹六号：围攻')}}">彩虹六号：围攻</a></li>
				<li><a href="{{ url ('search?searchStr=幽灵行动：荒野')}}">幽灵行动：荒野</a></li>
				<li><a href="{{ url ('search?searchStr=Switch')}}">Switch</a></li>
				<li><a href="{{ url ('search?searchStr=看门狗')}}">看门狗</a></li>
			</div>
			<div class="col-md-6 by1">
				<li><a href="{{ url ('search?searchStr=回复')}}">回复</a></li>
				<li><a href="{{ url ('search?searchStr=steam')}}">steam</a></li>
				<li><a href="{{ url ('search?searchStr=细胞分裂6')}}">细胞分裂6</a></li>
				<li><a href="{{ url ('search?searchStr=荣耀战魂')}}">荣耀战魂</a></li>
				<li><a href="{{ url ('search?searchStr=尼尔：机械纪元')}}">尼尔：机械纪元</a></li>
				<li><a href="{{ url ('search?searchStr=使命召唤14')}}">使命召唤14</a></li>
				<li><a href="{{ url ('search?searchStr=战地1')}}">战地1</a></li>
			</div>
				
			<div class="clearfix"> </div>
		</div>
			<div class="clearfix"></div>
			<div class="bottom">
				<p>Copyrights © 2015 {{$webName}} | Template by <a href="{{$webUrl}}">{{$webTitle}}</a></p>
			</div>
	</div>
</div>
<!-- 完成-底栏 -->
</body>
</html>