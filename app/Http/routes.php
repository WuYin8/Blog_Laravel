<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
路由设定举例
Route::get('/', function () {
    return view('welcome');
});
Route::get('foo', function () {
	return 'helloWorld';
});
Route::any('fanbing', function () {
	return '傻逼';
});
Route::get('index/{id}', 'IndexController@index');
Route::any('home/index', 'Home\UserController@index');
Route::any('home/register', 'Home\UserController@register');
*/

// 即使是不在前台作出展示的路由，也要在这里写明路径
// 首页使用的路径
Route::any('/' , 'IndexController@index');
Route::any('index' , 'IndexController@index');
// 博客列表使用的路径
Route::any('blog' , 'BlogController@blog');
// 博客详情页使用的路径
Route::any('single' , 'BlogController@noID');
Route::any('single/{tid}' , 'BlogController@single');
Route::any('addReply' , 'BlogController@addReply');
// 登录注册页面使用的路径
Route::any('user' , 'User\UserController@user');
Route::any('user/user' , 'User\UserController@user');
Route::any('user/user/Code' , 'User\UserController@Code');
Route::any('user/user/login' , 'User\UserController@login');
Route::any('user/user/register' , 'User\UserController@register');
Route::any('user/user/logout' , 'User\UserController@logout');
// 个人信息页面使用的路径
Route::any('user/info' , 'User\InfoController@info');
Route::any('user/change' , 'User\InfoController@change');
// 发表博文使用的路径
Route::any('send' , 'SendController@index');
Route::any('send/add' , 'SendController@addDetails');
// 搜索展示内容使用的路径
Route::any('search' , 'IndexController@search');
// 后台默认登录页面使用的路径
Route::any('admin/login' , 'Admin\AdminController@login');
Route::any('admin' , 'Admin\AdminController@login');
// 后台管理页面使用的路径
Route::any('admin/index' , 'Admin\AdminController@index');
Route::any('admin/content' , 'Admin\AdminController@content');
Route::any('admin/reply' , 'Admin\AdminController@reply');
Route::any('admin/userDel' , 'Admin\AdminController@userDel');
Route::any('admin/userUnlock' , 'Admin\AdminController@userUnlock');
Route::any('admin/userShit' , 'Admin\AdminController@userShit');
Route::any('admin/contentDel' , 'Admin\AdminController@contentDel');
Route::any('admin/contentUndel' , 'Admin\AdminController@contentUndel');
Route::any('admin/contentShit' , 'Admin\AdminController@contentShit');
Route::any('admin/replyDel' , 'Admin\AdminController@replyDel');
Route::any('admin/replyUndel' , 'Admin\AdminController@replyUndel');
Route::any('admin/replyShit' , 'Admin\AdminController@replyShit');
Route::any('admin/logout' , 'Admin\AdminController@logout');