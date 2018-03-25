<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use DB;
class BlogController extends Controller
{
	// 博客列表页面展示
	function blog()
	{
		//要展示的帖子信息，一页四个，同时配合分页
		$details = DB::table('details')->join('gallery' , 'details.pid' , '=' , 'gallery.pid')->
			where(function ($query) {
               	 		$query->where('first', '1')
                      			->where('details.isdel','0');
            			})
			->orderby('addtime' , 'desc')->paginate(4);

		//作者名字
		$author = DB::table('user')->where('undertype' , '1')->value('username');

		// 底栏需要筛选的内容
		$webTitle = DB::table('msg')->where('name' , 'webTitle')->value('content');
		$webName = DB::table('msg')->where('name' , 'webName')->value('content');
		$webUrl = DB::table('msg')->where('name' , 'webUrl')->value('content');
		$webInfo = DB::table('msg')->where('name' , 'webInfo')->value('content');
		$webMore = DB::table('msg')->where('name' , 'webMore')->value('content');
		$link = DB::table('link')->get();

		return view('blog' , ['details'=>$details , 'author'=>$author , 'webTitle'=>$webTitle , 'webName'=>$webName , 'webUrl'=>$webUrl , 'webInfo'=>$webInfo , 'webMore'=>$webMore , 'link'=>$link]);
	}
	//  博客未提供id
	function noID()
	{
		$msg = '这个文章被管理员吃掉了，去别的页面看看吧';
		$url = "/blog";
		return view('notice' , ['msg'=>$msg , 'url'=>$url]);
	}


	//博客详情页面添加回复
	function addReply()
	{
		// 判断是否登录
		if (empty(session('username'))) {
			$msg = '请登陆后再发表回复';
			$url = "/user/user";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
		$uid = session('uid');
		$content = $_POST['content'];
		$tid = $_GET['tid'];
		// 添加回复
		$isRepy = DB::table('details')->insert(['tid'=>$tid , 'authorid'=>$uid , 'content'=>$content , 'addtime'=>time()]);
		if ($isRepy) {
			//增加回帖数
			$replyCount = DB::table('details')->
				where(function ($query) use($tid) {
	               	 		$query->where('id', $tid)
	                      			->where('isdel','0')
	                      			->where('first','1');
	            			})
				->value('replycount');
			$replyCount = intval($replyCount) + 1;
			DB::table('details')->update(['replycount'=>$replyCount]);

			$msg = '发表回复成功';
			$url = "/single/" . $tid;
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		} else {
			$msg = '发表回复失败';
			$url = "/single/" . $tid;
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
	}
	
	//博客详情页面展示
	function single($tid)
	{
		
		//要展示的主帖子信息
		// if (empty($_GET['tid'])) {
		if (empty($tid)) {
			$msg = '这个文章被管理员吃掉了，去别的页面看看吧';
			$url = "/blog";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
		// $id = $_GET['tid'];
		$id = $tid;
		//点击量增加
		$hits = DB::table('details')->where('id' , $id)->value('hits');
		$hits = intval($hits) + 1;
		DB::table('details')->where('id' , $id)->update(['hits'=>$hits]);
		
		// 帖子与图片两表联查
		$details = DB::table('details')->join('gallery' , 'details.pid' , '=' , 'gallery.pid')->
			where(function ($query) use($id) {
               	 		$query->where('id', $id)
                      			->where('details.isdel','0');
            			})
			->get();
		if ($details == false) {
			$msg = '这个文章被管理员吃掉了，去别的页面看看吧';
			$url = "/blog";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
		$details = $details[0];

		//作者名字信息，名字和头像
		$author = DB::table('user')->where('undertype' , '1')->get();
		$author = $author[0];

		//要展示的帖子信息，一页6个
		//回帖数量
		$replyCount = DB::table('details')->
			where(function ($query) use($id) {
               	 		$query->where('tid', $id)
                      			->where('isdel','0')
                      			->where('first','0');
            			})
			->count();

		//回帖信息,两表联查出用户名和头像，分页也算在这里
		$reply = DB::table('details')->join('user' , 'details.authorid' , '=' , 'user.uid')->
			where(function ($query) use($id) {
               	 		$query->where('tid', $id)
                      			->where('details.isdel','0')
                      			->where('details.first','0');
            			})
			->orderby('addtime' , 'desc')->paginate(6);

		// 底栏需要筛选的内容
		$webTitle = DB::table('msg')->where('name' , 'webTitle')->value('content');
		$webName = DB::table('msg')->where('name' , 'webName')->value('content');
		$webUrl = DB::table('msg')->where('name' , 'webUrl')->value('content');
		$webInfo = DB::table('msg')->where('name' , 'webInfo')->value('content');
		$webMore = DB::table('msg')->where('name' , 'webMore')->value('content');
		$link = DB::table('link')->get();

		return view('single' , ['tid'=>$id , 'details'=>$details , 'author'=>$author , 'replyCount'=>$replyCount , 'reply'=>$reply , 'webTitle'=>$webTitle , 'webName'=>$webName , 'webUrl'=>$webUrl , 'webInfo'=>$webInfo , 'webMore'=>$webMore , 'link'=>$link]);
	}

}