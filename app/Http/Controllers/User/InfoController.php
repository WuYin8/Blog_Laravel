<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\User\Ucpaas; // 连接手机验证码类
use Illuminate\Http\Request; // 使用session需要
class InfoController extends Controller
{
	// 修改个人资料
	function change(Request $request)
	{
		// 判断是否登录
		if (empty(session('username'))) {
			$msg = '请登陆后进行操作';
			$url = "/user/user";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
		$uid = session('uid');

		// 用户名更改
		if (!empty($_POST['username'])) {
			$changeName = $_POST['username'];
			$changeNameExists = DB::table('user')->where('username' , $changeName)->value('uid');
			if ($changeNameExists) {
				$msg = '用户名已存在';
				$url = "/user/info";
				return view('notice' , ['msg'=>$msg , 'url'=>$url]);
			}
			// 更改用户名
			$result = DB::table('user')->where('uid' , $uid)->update(['username'=>$changeName]);
			session(['username'=>$changeName]);
		}

		// 旧密码不为空时，修改的资料
		if (!empty($_POST['pwd'])) {
			$oldPwd = md5($_POST['pwd']);
			$realPwd = DB::table('user')->where('uid' , $uid)->value('password');
			// 密码更改
			if (!empty($_POST['newPwd'])) {
				$newPwd = md5($_POST['newPwd']);
				// 判断旧密码是否正确
				if ($oldPwd == $realPwd) {
					// 更改密码
					$result = DB::table('user')->where('uid' , $uid)->update(['password'=>$newPwd]);
				} else {
					$msg = '旧密码不正确';
					$url = "/user/info";
					return view('notice' , ['msg'=>$msg , 'url'=>$url]);
				}
			}
			// 手机号更改
			if (!empty($_POST['phone'])) {
				$realPhone = DB::table('user')->where('uid' , $uid)->value('phone');
				$newPhone = $_POST['phone'];
				$changePhoneExists = DB::table('user')->where('phone' , $newPhone)->value('uid');
				// 判断旧密码是否正确
				if ($oldPwd == $realPwd) {
					// 更改手机号
					if ($changePhoneExists) {
						$msg = '该手机号已被注册';
						$url = "/user/info";
						return view('notice' , ['msg'=>$msg , 'url'=>$url]);
					} else {
						$result = DB::table('user')->where('uid' , $uid)->update(['phone'=>$newPhone]);
					}
				} else {
					$msg = '旧密码不正确';
					$url = "/user/info";
					return view('notice' , ['msg'=>$msg , 'url'=>$url]);
				}
			}
		}
	
		//上传头像
		if (!empty($_FILES['face']['name'])) {
			// 获取上传文件后缀
			$fileMime = strtolower(str_replace('/' , '' , strrchr($_FILES['face']['type'] , '/' )));
			$mimes = ['jpg' , 'jpeg' , 'gif' , 'png'];
			// 满足格式要求的图片，上传
			if (in_array($fileMime, $mimes)) {
				$newName = uniqid();
				$fileName = $newName. '.' . $fileMime;
				// 保存在文件夹中
				$request->file('face')->move('images/face' , $fileName);
				// 路径上传到数据库
				$picture = '/images/face/' . $fileName;
				$result = DB::table('user')->where('uid' , $uid)->update(['picture'=>$picture]);
				session(['pic'=>$picture]);
			} else {
				$msg = '上传头像不符合格式要求';
				$url = "/user/info";
				return view('notice' , ['msg'=>$msg , 'url'=>$url]);
			}
		}

		// 修改资料完成
		$msg = '修改个人资料完成';
		$url = "/user/info";
		return view('notice' , ['msg'=>$msg , 'url'=>$url]);
	}

	// 个人信息展示
	function info()
	{		
		// 判断是否登录
		if (empty(session('username'))) {
			$msg = '请登陆后进行操作';
			$url = "/user/user";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
		$uid = session('uid');

		// 获取用户信息
		// $userInfo = DB::table('user')->where('uid' , $uid)->get();

		// 底栏需要筛选的内容
		$webTitle = DB::table('msg')->where('name' , 'webTitle')->value('content');
		$webName = DB::table('msg')->where('name' , 'webName')->value('content');
		$webUrl = DB::table('msg')->where('name' , 'webUrl')->value('content');
		$webInfo = DB::table('msg')->where('name' , 'webInfo')->value('content');
		$webMore = DB::table('msg')->where('name' , 'webMore')->value('content');
		$link = DB::table('link')->get();

		return view('user.info' , ['webTitle'=>$webTitle , 'webName'=>$webName , 'webUrl'=>$webUrl , 'webInfo'=>$webInfo , 'webMore'=>$webMore , 'link'=>$link]);
	}
}