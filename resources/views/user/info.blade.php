<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>{{$webTitle}} - 个人资料</title>
<link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all">
<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Ladies Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="{{ URL::asset('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800') }}" rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{ URL::asset('css/flexslider.css') }}" type="text/css" media="screen" />
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('css/swipebox.css') }}">
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
			<!-- logo与登录状态区域 -->
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
			<!-- 完成-logo与登录状态区域 -->
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
						<li class="active"><a href="{{url ('user/info')}}">个人资料</a></li>
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
			<!-- 完成-目录与搜索区域 -->
		</div>
	</div>
<!-- 个人信息区域 -->
<div class="main">
	<div class="container">
	   <div class="content">	 	 
	 		<div class="section group">
			<div class="col-md-99 cont span_2_of_3">
			  <div class="contact-form">
			  <form  method = "post" id="changeForm" action = "{{url ('user/change')}}" enctype="multipart/form-data">
				<div class="contact-form-row">
			            <?php echo method_field('PUT'); ?>
			            <?php echo csrf_field(); ?>
					<div>
						<span class = 'tspan'>更改用户名 :</span>
						<input type="text" id="username" class="text" name = "username" placeholder="{{session('username')}}" />
					</div>
					<div>
						<span class = 'tspan'>更改头像 :</span>
						<img src = "{{session('pic')}}" width="50px" height="50px" />
						<input type="file" name="face" />
						<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
						<small>仅支持jpg、jpeg、png和gif格式的图片，大小限制为2M</small>
					</div>
					<div>
						<span class = 'tspan'>更改密码(旧密码) :</span>
						<input type="password" id="pwd" class="text" name = "pwd" placeholder="确认旧密码后才能修改密码与手机号" onfocus="this.value = '';" />
					</div>
					<div>
						<span class = 'tspan'>更改密码(新密码) :</span>
						<input type="password" id="newPwd" class="text" name = "newPwd" placeholder="密码长度为6~12字节" onfocus="this.value = '';"  />
					</div>
					<div>
						<span class = 'tspan'>更改手机号 :</span>
						<input type="text" id="phone" class="text" name = "phone" placeholder="确认旧密码后才能修改手机号" onfocus="this.value = '';"  />
					</div>
					<div class="clearfix"> </div>
					<input type="submit" name="submit" value="确认修改" onclick="change_info()" />
					<script type="text/javascript">
						function change_info()
						{
							// 用户名格式判断
							if ($('#username').val().length > 0) {
								if ($('#username').val().length < 6 || $('#username').val().length > 12) {
								  alert('用户名长度应在6~12位之间');
								  $('#changeForm').attr('onsubmit', 'return false');
								  return false;
								}
							}
							
							// 新密码格式判断
							$('#changeForm').attr('onsubmit', '');
							if ($('#pwd').val().length == 0) {
								if ($('#newPwd').val().length > 0) {
								  alert('填写旧密码后才能修改新密码');
								  $('#changeForm').attr('onsubmit', 'return false');
								  return false;
								}
							}
							if ($('#pwd').val().length > 0) {
								if ($('#pwd').val().length < 6) {
								  alert('密码长度不得小于6位');
								  $('#changeForm').attr('onsubmit', 'return false');
								  return false;
								}
								if ($('#newPwd').val().length > 0) {
									if ($('#newPwd').val().length < 6) {
									  alert('新密码长度不得小于6位');
									  $('#changeForm').attr('onsubmit', 'return false');
									  return false;
									}
								}
							}
							
							// 手机号格式判断
							$('#changeForm').attr('onsubmit', '');
							if ($('#pwd').val().length == 0) {
								if ($('#phone').val().length > 0) {
								  alert('填写旧密码后才能修改手机号');
								  $('#changeForm').attr('onsubmit', 'return false');
								  return false;
								}
							}
							if ($('#pwd').val().length > 0) {
								if ($('#pwd').val().length < 6) {
								  alert('密码长度不得小于6位');
								  $('#changeForm').attr('onsubmit', 'return false');
								  return false;
								}
								if ($('#phone').val().length > 0) {
									reg1 = /^[1][3,4,5,7,8][0-9]{9}$/;
									if (reg1.test($('#phone').val())) {
									} else {
									   alert('手机号码格式不正确');
									  $('#changeForm').attr('onsubmit', 'return false');
									  return false;
									}
								}
							}
						}
					</script>
				</div>
				</form>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-3 rsidebar span_1_of_3 services_list">
			    
			  </div>	
				<div class="clearfix"> </div>				  
	      </div>
		</div>
	</div>
</div>
<!-- 完成-个人信息区域 -->
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