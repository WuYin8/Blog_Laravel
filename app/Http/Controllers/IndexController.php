<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
	//搜索展示
	public function search()
	{
		// 判定搜索内容
		if (empty($_GET['searchStr'])) {
			$msg = '搜索内容不得为空';
			$url = "/index";
			return view('notice' , ['msg'=>$msg , 'url'=>$url]);
		}
		$searchStr = $_GET['searchStr'];
		
		//对用户名，主贴标题，主贴内容，回复内容进行搜索
		//用户名和照片
		$searchUsername = DB::table('user')->where('username' , 'like' , "%$searchStr%")->get();

		// 标题和连接
		$searchTitle = DB::table('details')->
			where(function ($query) use($searchStr) {
	               	 		$query->where('title' , 'like' , "%$searchStr%")
	                      			->where('first',1)
	                      			->where('isdel',0);
            			})
			->get();

		// 主贴和连接
		$searchContent = DB::table('details')->
			where(function ($query) use($searchStr) {
	               	 		$query->where('content' , 'like' , "%$searchStr%")
	                      			->where('first',1)
	                      			->where('isdel',0);
            			})
			->get();

		// 回帖与连接
		$searchReply = DB::table('details')->
			where(function ($query) use($searchStr) {
	               	 		$query->where('content' , 'like' , "%$searchStr%")
	                      			->where('first',0)
	                      			->where('isdel',0);
            			})
			->get();

		// 底栏需要筛选的内容
		$webTitle = DB::table('msg')->where('name' , 'webTitle')->value('content');
		$webName = DB::table('msg')->where('name' , 'webName')->value('content');
		$webUrl = DB::table('msg')->where('name' , 'webUrl')->value('content');
		$webInfo = DB::table('msg')->where('name' , 'webInfo')->value('content');
		$webMore = DB::table('msg')->where('name' , 'webMore')->value('content');
		$link = DB::table('link')->get();

		//什么都用写，代表显示app/view/index(控制器)/index(方法名字).html
		return view('search' , ['searchUsername'=>$searchUsername , 'searchTitle'=>$searchTitle , 'searchContent'=>$searchContent , 'searchReply'=>$searchReply , 'webTitle'=>$webTitle , 'webName'=>$webName , 'webUrl'=>$webUrl , 'webInfo'=>$webInfo , 'webMore'=>$webMore , 'link'=>$link]);
	}

	// 默认主页展示
	public function index()
	{
		//滚动画廊展示
		$galleryBig = DB::table('gallery')->orderby('pid' , 'desc')->take(6)->get();

		//画廊展示
		$gallery = DB::table('gallery')->orderby('pid' , 'asc')->take(8)->get();

		//近期的发帖
		$detailsThree = DB::table('details')->join('gallery' , 'details.pid' , '=' , 'gallery.pid')->
			where(function ($query) {
               	 		$query->where('first', '1')
                      			->where('details.isdel','0');
            			})
			->orderby('addtime' , 'desc')->take(3)->get();

		// 底栏需要筛选的内容
		$webTitle = DB::table('msg')->where('name' , 'webTitle')->value('content');
		$webName = DB::table('msg')->where('name' , 'webName')->value('content');
		$webUrl = DB::table('msg')->where('name' , 'webUrl')->value('content');
		$webInfo = DB::table('msg')->where('name' , 'webInfo')->value('content');
		$webMore = DB::table('msg')->where('name' , 'webMore')->value('content');
		$link = DB::table('link')->get();

		//什么都用写，代表显示app/view/index(控制器)/index(方法名字).html
		return view('index' , ['galleryBig'=>$galleryBig , 'gallery'=>$gallery , 'detailsThree'=>$detailsThree , 'webTitle'=>$webTitle , 'webName'=>$webName , 'webUrl'=>$webUrl , 'webInfo'=>$webInfo , 'webMore'=>$webMore , 'link'=>$link]);
	}
}