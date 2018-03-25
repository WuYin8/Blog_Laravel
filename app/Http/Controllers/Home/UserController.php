<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use DB;
class UserController extends Controller
{
	public function index ()
	{
		$users = DB::table('tryo')->paginate(4);
		//var_dump($users);
		return view('home.index', ['users'=>$users]);
	}
	public function register()
	{
		return view('home.register');
	}
}