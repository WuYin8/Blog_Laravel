<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use DB;
class SendController extends Controller
{
	//发表帖子
	function addDetails()
	{
		// 判断是否登录，判断登录用户是否为博主
		if (empty(session('undertype'))) {
			if (session('undertype') != 1) {
				$msg = '当前只允许博主发表博客';
				$url = "/index";
				return view('notice' , ['msg'=>$msg , 'url'=>$url]);
			}	
		}

		// 获取表单内容，博客标题与内容
		$title = $_POST['title'];
		$content = $_POST['content'];

		// 随机一个封面图片
		$pcID = DB::table('gallery')->count('pid');
		$pcID--;
		$randID = rand(0 , $pcID);

		$isSend = DB::table('details')->insert(['first'=>1 , 'tid'=>0 , 'pid'=>$randID , 'authorid'=>session('uid') , 'title'=>$title , 'content'=>$content , 'addtime'=>time()]);
		if ($isSend) {
			$tid = DB::table('details')->
				where(function ($query) use($title , $content , $randID) {
	               	 		$query->where('title', $title)
	                      			->where('content',$content)
	                      			->where('pid',$randID);
	            			})
				->value('id');
			$msg = '发表成功，正在前往博客文章页面';
			$url = "/single/" . $tid;
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		} else {
			$msg = '发表失败，请重试';
			$url = "/send";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
	}

	// 默认发帖操作页面展示
	function index()
	{
		// 判断是否登录，判断登录用户是否为博主
		if (empty(session('undertype'))) {
			if (session('undertype') != 1) {
				$msg = '当前只允许博主发表博客';
				$url = "/index";
				return view('notice' , ['msg'=>$msg , 'url'=>$url]);
			}	
		}

		// 底栏需要筛选的内容
		$webTitle = DB::table('msg')->where('name' , 'webTitle')->value('content');
		$webName = DB::table('msg')->where('name' , 'webName')->value('content');
		$webUrl = DB::table('msg')->where('name' , 'webUrl')->value('content');
		$webInfo = DB::table('msg')->where('name' , 'webInfo')->value('content');
		$webMore = DB::table('msg')->where('name' , 'webMore')->value('content');
		$link = DB::table('link')->get();

		return view('send' , ['webTitle'=>$webTitle , 'webName'=>$webName , 'webUrl'=>$webUrl , 'webInfo'=>$webInfo , 'webMore'=>$webMore , 'link'=>$link]);
	}
}