<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\User\Ucpaas; // 连接手机验证码类
use Illuminate\Http\Request; // 使用session需要
class UserController extends Controller
{
	//登录判断
	function login(Request $request)
	{
		// 用户名是否存在
		$loginName = $_POST['loginName'];
		$loginNameExists = DB::table('user')->where('username' , $loginName)->value('uid');
		if (!$loginNameExists) {
			$msg = '用户名不存在';
			$url = "/user/user";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
		// 是否允许用户登录
		$allowLogin = DB::table('user')->where('username' , $loginName)->value('allowlogin');
		if ($allowLogin == '1') {
			$msg = '该用户被屏蔽';
			$url = "/user/user";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
		// 密码是否正确
		$loginPwd = md5($_POST['loginPwd']);
		$realPwd = DB::table('user')->where('username' , $loginName)->value('password');
		if ($loginPwd !== $realPwd) {
			$msg = '密码不正确';
			$url = "/user/user";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
		// 登录成功，存储session
		$uid = DB::table('user')->where('username' , $loginName)->value('uid');
		$picture = DB::table('user')->where('username' , $loginName)->value('picture');
		$undertype = DB::table('user')->where('username' , $loginName)->value('undertype');
		$request->session()->put('uid', $uid);
		$request->session()->put('username', $loginName);
		$request->session()->put('pic', $picture);
		$request->session()->put('undertype', $undertype);

		$msg = '登录成功';
		$url = "/index";
		return view('notice' , ['msg'=>$msg , 'url'=>$url]);
	}
	//登出
	function logout(Request $request)
	{
		$request->session()->flush();
		$msg = '账号退出成功，正在返回首页';
		$url = '/index';
		return view('notice' , ['msg'=>$msg , 'url'=>$url]);
	}
	//注册判断
	function register(Request $request)
	{
		// 验证码是否获取
		if (empty($request->session()->get('code'))) {
			$msg = '验证码获取失败，请重新拉取';
			$url = "/user/user";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
		$scode = $request->session()->get('code');
		// 用户名是否存在
		$registerName = $_POST['registerName'];
		$registerNameExists = DB::table('user')->where('username' , $registerName)->value('uid');
		if ($registerNameExists) {
			$msg = '用户名已存在';
			$url = "/user/user";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
		$registerPwd = md5($_POST['registerPwd']);
		// 手机号是否存在
		$phone = $_POST['phone'];
		$registerPhoneExists = DB::table('user')->where('phone' , $phone)->value('uid');
		if ($registerPhoneExists) {
			$msg = '手机号已被注册';
			$url = "/user/user";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		$code = $_POST['code'];

		if($code !== $scode){
			$msg = '验证码输入错误，请重试';
			$url = "/user/user";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}else{
			$addUser = DB::table('user')->insert(['username'=>$registerName , 'password'=>$registerPwd , 'phone'=>$phone]);
			$msg = '注册成功，正在前往登录页面';
			$url = "/user/user";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
	    	}
	}
	// 手机验证码接口用
	function Code(Request $request)
	{
		//初始化必填
		$options['accountsid']='19a6efc75833a611174be919347c4e48';
		$options['token']='0cebe3d404b6405cba9412dcdaac438c';

		//初始化 $options必填
		$ucpass = new Ucpaas($options);

		//开发者账号信息查询默认为json或xml
		header("Content-Type:text/html;charset=utf-8");


		//封装验证码
		$str = '1234567890123567654323894325789';
		$code = substr(str_shuffle($str),0,5);
		$request->session()->put('code', $code);
		//短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
		$appId = "5957fe0cfb234f68bff623c7fcded2f8";
		//给那个手机号发送
		$to = $_GET['phone'];

		$templateId = "251655";
		//这就是验证码
		$param=$code;
		$word = $ucpass->templateSMS($appId,$to,$templateId,$param); 
	        	file_put_contents('1.txt', $word);
	}
	// 默认登录注册页面
	function user(Request $request)
	{
		// 判断是否已登录
		if (!empty($request->session()->get('uid'))) {
			$msg = '您已登录，请退出账号后再操作';
			$url = "/index";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}	
		return view('user.user');
	}
}