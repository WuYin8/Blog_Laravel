<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>{{$webTitle}} - 发表博客</title>
<link href="{{ URL::asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all">
<link href="{{ URL::asset('/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="{{ URL::asset('/editor/css/editormd.css') }}" />
		<script src="{{ URL::asset('/editor/js/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('/editor/editormd.min.js') }}"></script>
		<script type="text/javascript">
			$(function() {
				testEditor = editormd("test-editormd", {
						width   : "100%",
						height  : 600,
						syncScrolling : "single",
						path    : "/editor/lib/"
					});

			});
		</script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Ladies Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="{{ URL::asset('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800') }}" rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{ URL::asset('/css/flexslider.css') }}" type="text/css" media="screen" />
<script src="{{ URL::asset('/js/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('/css/swipebox.css') }}">
 <!------ Light Box ------>
    <script src="{{ URL::asset('/js/jquery.swipebox.min.js') }}"></script> 
    <script type="text/javascript">
		jQuery(function($) {
			$(".swipebox").swipebox();
		});
	</script>
    <!------ Eng Light Box ------>
	 <script src="{{ URL::asset('/js/responsiveslides.min.js') }}"></script>
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
			<!-- logo与登录状态区 -->
			<div class="logo">
				<a href="{{url ('index')}}"><img src="{{ URL::asset('/images/logo.png') }}" class="img-responsive" alt=""></a>
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
			<!-- 完成-logo和登录状态区 -->
			<!-- 目录与搜索区域 -->
			<div class="header-bottom">
				<div class="head-nav">
					<span class="menu"> </span>
						<ul class="cl-effect-3">
							<li><a href="{{url ('index')}}">首页</a></li>
							<li><a href="{{url ('blog')}}">博客</a></li>
							@if (empty(session('username')))
							<li><a href="{{url ('user/user')}}">登录</a></li>
							@else
							<li><a href="{{url ('user/info')}}">个人资料</a></li>
								@if (session('undertype') == 1)
								<li class="active"><a href="{{url ('send')}}">发表</a></li>
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
			<!-- 完成-目录与搜索区域 -->
		</div>
	</div>
	<div class="main">
		<div class="container">
		<!-- 文章编辑区 -->
		   <div class="content">	 	 
		 		<div class="section group">
				<div class="col-md-9 cont span_2_of_3">
				<div class="contact-form">
					<form  method = "post" action = "{{url ('send/add')}}" id="sendForm">
						<div class="contact-form-row">
							<div class = "title">
							<?php echo method_field('PUT'); ?>
            						<?php echo csrf_field(); ?>
								<span class = 'tspan'>标题 :</span>
								<input type="text" class="text" name = "title" id="title" maxlength="30" placeholder="标题长度不得超过30字节" onfocus="if (this.value == '' || this.value == '标题长度不得超过30字节') {this.value = '';}" onblur="if (this.value == '') {this.value = '标题长度不得超过30字节';}" />
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="clearfix"> </div>
						<div class="contact-form-row2">
							<span class = 'tspan'>正文 :</span>
							<div class="replyMd" id="test-editormd">
							<textarea style="display:none;" name="content" id="content"></textarea>
						</div>
						<div>
							<span class = 'tspan'>网站会从图库中随机为文章选择配图</span>
						</div>
							

						</div>
						<input type="submit" value="发&nbsp;表" onclick="add_details()" />
						<script type="text/javascript">
							function add_details()
							{
								// 博客标题格式判断
								if ($('#title').val().length == 0) {
									alert('博客标题不得为空');
									$('#sendForm').attr('onsubmit', 'return false');
									return false;
								}
								$('#sendForm').attr('onsubmit', '');
								if ($('#title').val().length > 30) {
									alert('博客标题长度不得超过30个字符');
									$('#sendForm').attr('onsubmit', 'return false');
									return false;
								}
								// 博客内容格式判断
								$('#sendForm').attr('onsubmit', '');
								if ($('#content').val().length == 0) {
									alert('博客内容不得为空');
									$('#sendForm').attr('onsubmit', 'return false');
									return false;
								}
							}
						</script>
						<br /><br />
					</form>
				</div>
				<div class="col-md-3 rsidebar span_1_of_3 services_list">
				    
				  </div>	
					<div class="clearfix"> </div>				  
		      </div>
			</div>
		</div>
		<!-- 完成-文章编辑区 -->
	</div>
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