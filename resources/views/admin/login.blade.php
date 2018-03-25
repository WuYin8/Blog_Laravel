<!DOCTYPE HTML>
<html dir="ltr" lang="en-US">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>后台登录</title>

	<!--- CSS --->
	<link rel="stylesheet" href="{{ URL::asset('/css/styleAdminLogin.css') }}" type="text/css" />


	<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->

	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="{{ URL::asset('/js/jquery-1.7.1.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('/js/selectivizr.js') }}"></script>
		<noscript><link rel="stylesheet" href="{{ URL::asset('/css/fallback.css') }}" /></noscript>
	<![endif]-->

	</head>

	<body>
		<div id="container">
			<form action="{{url ('admin/index')}}" method="post" id="adminLoginForm">
				<?php echo method_field('PUT'); ?>
				<?php echo csrf_field(); ?>
				<div class="login">后台管理登录</div>
				<div class="username-text">Username:</div>
				<div class="password-text">Password:</div>
				<div class="username-field">
					<input type="text" id="username" name="username" placeholder ="管理员用户名" />
				</div>
				<div class="password-field">
					<input type="password" id="password" name="password" placeholder ="密码" />
				</div>
				<div class="login2" width="200px"><a href="{{url ('index')}}">返回前台页面</a></div>
				<input type="submit" name="submit" value="GO" onclick="adminTest()" />
				<script type="text/javascript"  src="{{ URL::asset('/js/jquery-1.7.1.min.js')}}"></script>
				<script type="text/javascript">
					function adminTest()
					{	
						if ($('#username').val().length == 0 && $('#password').val().length == 0) {
							$('#adminLoginForm').attr('onsubmit' , 'return false');
							return false;
						}
						$('#adminLoginForm').attr('onsubmit' , '');
						if ($('#username').val().length > 0 && $('#password').val().length == 0) {
							alert('密码未填写');
							$('#adminLoginForm').attr('onsubmit' , 'return false');
							return false;
						}
						$('#adminLoginForm').attr('onsubmit' , '');
						if ($('#username').val().length == 0 && $('#password').val().length > 0) {
							alert('用户名未填写');
							$('#adminLoginForm').attr('onsubmit' , 'return false');
							return false;
						}
						$('#adminLoginForm').attr('onsubmit' , '');
					}
				</script>
			</form>
		</div>
	</body>
</html>
