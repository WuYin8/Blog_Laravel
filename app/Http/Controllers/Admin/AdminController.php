<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request; // 使用session需要
class AdminController extends Controller
{
	// 默认登录页面的方法
	function login()
	{
		return view('admin.login');
	}
	// 登录判断方法与登录后默认展示用户方法
	function index()
	{
		// 判断是否允许登录
		if (!empty($_POST)) {
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			$nameEixsts = DB::table('user')->where('username' , $username)->value('uid');
			if ($nameEixsts) {
				
			} else {
				$msg = '用户名不存在';
				$url = "/admin";
				return view('notice' , ['msg'=>$msg , 'url'=>$url]);
			}

			$isAdmin = DB::table('user')->where('username' , $username)->value('undertype');
			if ($isAdmin != 1) {
				echo $isAdmin;
				$msg = '需要管理员权限';
				$url = "/admin";
				return view('notice' , ['msg'=>$msg , 'url'=>$url]);
			}
			
			$pwdAdmin = DB::table('user')->where('username' , $username)->value('password');
			if ($password !== $pwdAdmin) {
				$msg = '密码不正确';
				$url = "/admin";
				return view('notice' , ['msg'=>$msg , 'url'=>$url]);
			}

			// 判断完成，允许登录，设置一套和前台区分的session
			$adminUid = DB::table('user')->where('username' , $username)->value('uid');
			$adminPic = DB::table('user')->where('username' , $username)->value('picture');
			$adminUndertype = DB::table('user')->where('username' , $username)->value('undertype');
			session(['adminName'=>$username]);
			session(['adminUid'=>$adminUid]);
			session(['adminPic'=>$adminPic]);
			session(['adminUndertype'=>$adminUndertype]);
		}

		// 判断用户是否允许浏览
		if (empty(session('adminUndertype')) || session('adminUndertype') != '1') {
			$msg = '需要管理员权限';
			$url = "/admin";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		// 展示用户管理界面，同时配合分页
		$users = DB::table('user')->where('allowlogin', '0')->paginate(6);

		return view('admin.index' , ['users'=>$users]);
	}

	// 登出方法
	function logout(Request $request)
	{
		// 销毁所有的session选项
		$request->session()->flush();
		$msg = '退出成功，正在返回';
		$url = "/admin";
		return view('notice' , ['msg'=>$msg , 'url'=>$url]);
	}

	// 锁定用户
	function userDel()
	{
		// 判断用户是否允许浏览
		if (empty(session('adminUndertype')) || session('adminUndertype') != '1') {
			$msg = '需要管理员权限';
			$url = "/admin";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		// 判断是锁定操作
		if (!empty($_POST['uid'])) {
			$displayID = $_POST['uid'];
			$userDel = DB::table('user')->whereIn('uid' , $displayID)->update(['allowlogin'=>'1']);
			if ($userDel) {
				header('Location:/admin/index');
				exit;
			} else {
				$msg = '修改失败';
				$url = "/admin/index";
				return view('notice' , ['msg'=>$msg , 'url'=>$url]);
			}
		}

		// 判断为显示已锁定用户的界面,同时配合分页
		$users = DB::table('user')->where('allowlogin', '1')->paginate(6);
		return view('admin.userDel' , ['users'=>$users]);
	}
	//解锁用户
	function userUnlock()
	{
		// 判断用户是否允许浏览
		if (empty(session('adminUndertype')) || session('adminUndertype') != '1') {
			$msg = '需要管理员权限';
			$url = "/admin";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		// 判断是解锁操作
		if (!empty($_POST['uid'])) {
			$displayID = $_POST['uid'];
			$userDel = DB::table('user')->whereIn('uid' , $displayID)->update(['allowlogin'=>'0']);
			if ($userDel) {
				header('Location:/admin/userDel');
				exit;
			} else {
				$msg = '修改失败';
				$url = "/admin/index";
				return view('notice' , ['msg'=>$msg , 'url'=>$url]);
			}
		}

		// 判断为显示已锁定用户的界面,同时配合分页
		$users = DB::table('user')->where('allowlogin', '1')->paginate(6);
		return view('admin.userDel' , ['users'=>$users]);
	}
	//删除用户
	function userShit()
	{
		// 判断用户是否允许浏览
		if (empty(session('adminUndertype')) || session('adminUndertype') != '1') {
			$msg = '需要管理员权限';
			$url = "/admin";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		if (empty($_GET['shitID'])) {
			$msg = '未执行删除操作';
			$url = "/admin/userDel";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		$shitID = $_GET['shitID'];
		// 管理员（博主）不能删除
		$undertype = DB::table('user')->where('uid', $shitID)->value('undertype');
		if ($undertype == '1') {
			$msg = '管理员不能删除';
			$url = "/admin/userDel";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
		$users = DB::table('user')->where('uid', $shitID)->delete();
		// 同时删除该用户的回复
		$details = DB::table('details')->where('authorid', $shitID)->delete();
		if ($users) {
			$msg = '删除用户成功';
			$url = "/admin/userDel";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		} else {
			$msg = '删除用户失败';
			$url = "/admin/userDel";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
	}

	//文章管理
	function content()
	{
		// 判断用户是否允许浏览
		if (empty(session('adminUndertype')) || session('adminUndertype') != '1') {
			$msg = '需要管理员权限';
			$url = "/admin";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		// 展示文章管理界面，同时配合分页
		$contents = DB::table('details')->
			where(function ($query) {
               	 		$query->where('isdel', '0')
                      			->where('first','1');
            			})
			->orderby('addtime' , 'desc')->paginate(8);

		return view('admin.content' , ['contents'=>$contents]);
	}

	//文章回收
	function contentDel()
	{
		// 判断用户是否允许浏览
		if (empty(session('adminUndertype')) || session('adminUndertype') != '1') {
			$msg = '需要管理员权限';
			$url = "/admin";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		// 判断是回收文章操作
		if (!empty($_POST['id'])) {
			$displayID = $_POST['id'];
			$userDel = DB::table('details')->whereIn('id' , $displayID)->update(['isdel'=>'1']);
			// 文章下的回复也要回收
			$replyDel = DB::table('details')->whereIn('tid' , $displayID)->update(['isdel'=>'1']);
			if ($userDel) {
				header('Location:/admin/content');
				exit;
			} else {
				$msg = '修改失败';
				$url = "/admin/content";
				return view('notice' , ['msg'=>$msg , 'url'=>$url]);
			}
		}

		// 判断为显示已回收文章的界面,同时配合分页
		$contents = DB::table('details')->
			where(function ($query) {
               	 		$query->where('isdel', '1')
                      			->where('first','1');
            			})
			->orderby('addtime' , 'desc')->paginate(8);
		return view('admin.contentDel' , ['contents'=>$contents]);
	}
	//文章恢复
	function contentUndel()
	{
		// 判断用户是否允许浏览
		if (empty(session('adminUndertype')) || session('adminUndertype') != '1') {
			$msg = '需要管理员权限';
			$url = "/admin";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		// 判断是恢复文章操作
		if (!empty($_POST['id'])) {
			$displayID = $_POST['id'];
			$userDel = DB::table('details')->whereIn('id' , $displayID)->update(['isdel'=>'0']);
			// 文章下的回复也要恢复
			$replyDel = DB::table('details')->whereIn('tid' , $displayID)->update(['isdel'=>'0']);
			if ($userDel) {
				header('Location:/admin/contentDel');
				exit;
			} else {
				$msg = '修改失败';
				$url = "/admin/contentDel";
				return view('notice' , ['msg'=>$msg , 'url'=>$url]);
			}
		}

		// 判断为显示已回收文章的界面,同时配合分页
		$contents = DB::table('details')->
			where(function ($query) {
               	 		$query->where('isdel', '1')
                      			->where('first','1');
            			})
			->orderby('addtime' , 'desc')->paginate(8);
		return view('admin.contentDel' , ['contents'=>$contents]);
	}
	//文章删除
	function contentShit()
	{
		// 判断用户是否允许浏览
		if (empty(session('adminUndertype')) || session('adminUndertype') != '1') {
			$msg = '需要管理员权限';
			$url = "/admin";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		if (empty($_GET['shitID'])) {
			$msg = '未执行删除操作';
			$url = "/admin/contentDel";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		$shitID = $_GET['shitID'];
		$users = DB::table('details')->where('id', $shitID)->delete();
		// 删除文章同时删除回复
		$content = DB::table('details')->where('tid', $shitID)->delete();
		if ($users) {
			$msg = '删除文章成功';
			$url = "/admin/contentDel";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		} else {
			$msg = '删除文章失败';
			$url = "/admin/contentDel";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
	}

	//回复管理
	function reply()
	{
		// 判断用户是否允许浏览
		if (empty(session('adminUndertype')) || session('adminUndertype') != '1') {
			$msg = '需要管理员权限';
			$url = "/admin";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		// 展示回复管理界面，同时配合分页
		$replys = DB::table('details')->
			where(function ($query) {
               	 		$query->where('isdel', '0')
                      			->where('first','0');
            			})
			->orderby('addtime' , 'desc')->paginate(12);
		// 配合回复的foreach，获取文章的标题
		$contents = DB::table('details')->where('first','1')->get();

		return view('admin.reply' , ['replys'=>$replys , 'contents'=>$contents]);
	}

	//回复回收
	function replyDel()
	{
		// 判断用户是否允许浏览
		if (empty(session('adminUndertype')) || session('adminUndertype') != '1') {
			$msg = '需要管理员权限';
			$url = "/admin";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		// 判断是回收回复操作
		if (!empty($_POST['id'])) {
			$displayID = $_POST['id'];
			$userDel = DB::table('details')->whereIn('id' , $displayID)->update(['isdel'=>'1']);
			if ($userDel) {
				header('Location:/admin/reply');
				exit;
			} else {
				$msg = '修改失败';
				$url = "/admin/reply";
				return view('notice' , ['msg'=>$msg , 'url'=>$url]);
			}
		}

		// 判断为显示已回收文章的界面,同时配合分页
		$replys = DB::table('details')->
			where(function ($query) {
               	 		$query->where('isdel', '1')
                      			->where('first','0');
            			})
			->orderby('addtime' , 'desc')->paginate(8);
		// 配合回复的foreach，获取文章的标题
		$contents = DB::table('details')->where('first','1')->get();

		return view('admin.replyDel' , ['contents'=>$contents , 'replys'=>$replys]);
	}
	//回复恢复
	function replyUndel()
	{
		// 判断用户是否允许浏览
		if (empty(session('adminUndertype')) || session('adminUndertype') != '1') {
			$msg = '需要管理员权限';
			$url = "/admin";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		// 判断是恢复回复操作
		if (!empty($_POST['id'])) {
			$displayID = $_POST['id'];
			$userDel = DB::table('details')->whereIn('id' , $displayID)->update(['isdel'=>'0']);
			if ($userDel) {
				header('Location:/admin/replyDel');
				exit;
			} else {
				$msg = '修改失败';
				$url = "/admin/replyDel";
				return view('notice' , ['msg'=>$msg , 'url'=>$url]);
			}
		}
	}
	//回复删除
	function replyShit()
	{
		// 判断用户是否允许浏览
		if (empty(session('adminUndertype')) || session('adminUndertype') != '1') {
			$msg = '需要管理员权限';
			$url = "/admin";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		if (empty($_GET['shitID'])) {
			$msg = '未执行删除操作';
			$url = "/admin/replyDel";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}

		$shitID = $_GET['shitID'];
		$users = DB::table('details')->where('id', $shitID)->delete();
		if ($users) {
			$msg = '删除回复成功';
			$url = "/admin/replyDel";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		} else {
			$msg = '删除回复失败';
			$url = "/admin/replyDel";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
	}
}