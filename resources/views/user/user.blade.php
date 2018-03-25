<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<title>登录/注册</title>
<meta name="description" content="HTML5交互式注册登录切换jQuery特效代码，用户体验友好！" /> 
<meta name="keywords" content="HTML5,交互式,注册登录,切换,jQuery特效代码" />
<meta name="author" content="js代码" />
<meta name="Copyright" content="js代码" />
<link rel="stylesheet" href="{{ URL::asset('/css/styleUser.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/public/bootstrap3/css/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('/public/bootstrap3/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('/public/bootstrap3/css/bootstrap.css') }}">
  <script type="text/javascript" src="{{ URL::asset('/public/jquery-1.8.1.min.js') }}"></script>
  <style>
    .butt{
      width:274px;
    }
  </style>
</head>
<body>
<body>
<div class="cotn_principal">
<div class="logo">
  <a href="{{url ('index')}}"><img src="{{ URL::asset('/images/logo.png') }}" class="img-responsive" alt="" title = "点击回到首页"></a>
<div class="user">
  <div class="cont_centrar">
    <div class="cont_login">
      <div class="cont_info_log_sign_up">
        <div class="col_md_login">
          <div class="cont_ba_opcitiy">
            <h2>登录</h2>
            <p>已有账号，直接登录！</p>
            <button class="btn_login" onclick="cambiar_login()">登录</button>
          </div>
        </div>
        <div class="col_md_sign_up">
          <div class="cont_ba_opcitiy">
            <h2>注册</h2>
            <p>还没有账号？免费注册！</p>
            <button class="btn_sign_up" onclick="cambiar_sign_up()">注册</button>
          </div>
        </div>
      </div>
      <div class="cont_back_info">
        <div class="cont_img_back_grey"> <img src="{{ URL::asset('/images/po.jpg') }}" alt="" /> </div>
      </div>
      <div class="cont_forms" >
        <div class="cont_img_back_"> <img src="{{ URL::asset('/images/po.jpg') }}" alt="" /> </div>
        <form id="loginForm" method = "post" action = "{{url ('user/user/login')}}">
          <div class="cont_form_login"> <a href="#" onclick="ocultar_login_sign_up()" >X</a>
            <h2>登录</h2>
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>
              <input type="text" id="loginName" name = "loginName" placeholder="用户名称" />
              <input type="password" id="loginPwd" name = "loginPwd" placeholder="密码" />
              <button class="btn_login" onclick="loginNow()">登录</button>
              <script type="text/javascript">
                function loginNow()
                {
                  // 用户名格式判断
                  if ($('#loginName').val().length < 6 || $('#loginName').val().length > 12) {
                    alert('用户名长度应在6~12位之间');
                    $('#loginForm').attr('onsubmit', 'return false');
                    return false;
                  }
                  // 密码格式判断
                  $('#loginForm').attr('onsubmit', '');
                  if ($('#loginPwd').val().length < 6) {
                    alert('密码长度不得小于6位');
                    $('#loginForm').attr('onsubmit', 'return false');
                    return false;
                  }
                  // 格式判断完成，交给表单传到后台
                  $('#loginForm').attr('onsubmit', '');
                }
              </script>
          </div>
        </form>
        <form id="registerForm" method = "post" action = "{{url ('user/user/register')}}">
          <div class="cont_form_sign_up"> <a href="#" onclick="ocultar_login_sign_up()">X</a>
            <h2>注册</h2>
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>
            <input type="text" id="registerName" name = "registerName" placeholder="用户名长度为6~12位" />
            <input type="password" id="registerPwd" name = "registerPwd" placeholder="密码长度为6~12位" />
            <input type="password" id="registerPwd2" name = "registerPwd2" placeholder="确认密码" />
            <input type="text" id="phone" name = "phone" placeholder="手机号码" />
            <input class = "phoneCode" id="code" name = "code" type="text" placeholder="手机验证码" />
            <a href='javascript:;'  class="btn btn-info" id='getcode' onclick='getcode()'>获取验证码</a>
            <script>
              function getcode()
              {
                $('#getcode').text('60秒后重新获取');
                $('#getcode').removeAttr('onclick');
                var phone = $('#phone').val();
                //写个定时修改文本settime
                var time = 59;
                var into = setInterval(function(){

                  $('#getcode').text(time+'秒后重新获取');
                  time =time -1;
                  if(time<=-1){
                    clearInterval(into);
                    $('#getcode').text('获取验证码');
                    $('#getcode').attr('onclick');
                  }
                },1000);
                // alert(phone);
                //ajax    参数1,url  index1.php   参数2, 数据   1234565432
                $.get("{{url ('user/user/Code')}}",{phone:phone},function(date){
                  console.log(date);
                });
              }
            </script>
            <button class="btn_sign_up" onclick="sign_up()">注册</button>
            <script type="text/javascript">
              function sign_up()
              {
                // 用户名格式判断
                if ($('#registerName').val().length < 6 || $('#registerName').val().length > 12) {
                  alert('用户名长度应在6~12位之间');
                  $('#registerForm').attr('onsubmit', 'return false');
                  return false;
                }
                // 密码格式判断
                $('#registerForm').attr('onsubmit', '');
                if ($('#registerPwd').val().length < 6) {
                  alert('密码长度不得小于6位');
                  $('#registerForm').attr('onsubmit', 'return false');
                  return false;
                }
                $('#registerForm').attr('onsubmit', '');
                if ($('#registerPwd').val() != $('#registerPwd2').val()) {
                  alert('两次输入的密码不一致');
                  $('#registerForm').attr('onsubmit', 'return false');
                  return false;
                }
                // 手机号格式判断
                $('#registerForm').attr('onsubmit', '');
                reg1 = /^[1][3,4,5,7,8][0-9]{9}$/;
                if (reg1.test($('#phone').val())) {
                } else {
                   alert('手机号码格式不正确');
                  $('#registerForm').attr('onsubmit', 'return false');
                  return false;
                }
                // 验证码格式判断
                $('#registerForm').attr('onsubmit', '');
                if ($('#code').val().length == 0) {
                  alert('验证码未填写');
                  $('#registerForm').attr('onsubmit', 'return false');
                  return false;
                }
                // 格式判断完成，交给表单传到后台
                $('#registerForm').attr('onsubmit', '');
              }
            </script>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="{{ URL::asset('/js/user.js') }}"></script>
</body>
</body>
</html>
