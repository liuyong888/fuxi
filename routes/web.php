<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 后台登录
Route::resource('/adminlogin','Admin\AdminLoginController');

Route::group(["middleware"=>'login'],function(){	
	//后台搭建
	Route::resource("/admin","Admin\AdminController");
	//用户模块
	Route::resource("/adminusers","Admin\UsersController");
	//Ajax删除
	Route::get("/adminuserdel","Admin\UsersController@del");
	//模型之会员模块管理
	Route::resource("/adminuser","Admin\UserController");
	//获取会员收货地址
	Route::get("/adminaddress/{id}","Admin\UserController@address");
	//无限分类模块
	Route::resource("/admincates","Admin\CateController");
	// 管理员管理
	Route::resource("/adminuserss","Admin\AdminuserController");
	// 分配角色
	Route::get("/adminrole/{id}","Admin\AdminuserController@role");
	// 保存角色
	Route::post("/saverole","Admin\AdminuserController@saverole");
	// 角色管理
	Route::resource("/rolelist","Admin\AdminRolelistController");
	// 权限分配
	Route::get("/auth/{rid}","Admin\AdminRolelistController@auth");
	// 保存权限
	Route::post("/saveauth","Admin\AdminRolelistController@saveauth");

	// 权限管理
	Route::resource("/authlist","Admin\AuthlistController");
	// 文章管理
	Route::resource("/article","Admin\ArticleController");
	//ajax批量删除文章
	Route::get("/articledel_ajax","Admin\ArticleController@del_ajax");

	// 公告管理
	Route::resource("/abs","Admin\AbsController");
	// 商品管理
	Route::resource("/admingoods","Admin\AdminGoodsController");
});


//前台首页
Route::resource("/","Home\IndexController");
Route::resource("/homeindex","Home\IndexController");
// 注册页面
Route::resource("/homeregister","Home\RegisterController");
// 发字符串邮件
Route::get("/sendmail","Home\RegisterController@send_mail");
// 发纯文本视图邮件
Route::get("/sendmail2","Home\RegisterController@send_mail2");

// 激活
Route::get("/jihuo","Home\RegisterController@jihuo");

// 验证码测试
Route::get("/code","Home\RegisterController@code");




