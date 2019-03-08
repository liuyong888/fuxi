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

// 前台登录
Route::resource("/login","Home\LoginController");
// 忘记密码
Route::get("/forget_pwd","Home\LoginController@forget");
// 找回密码(发送邮件)
Route::post("/do_forget","Home\LoginController@do_forget");
// 加载重置密码
Route::get("/reset_pwd_view","Home\LoginController@reset_pwd_view");
// 重置密码
Route::post("/update_pwd","Home\LoginController@update_pwd");

//前台首页
Route::resource("/","Home\IndexController");
Route::resource("/homeindex","Home\IndexController");
// 前台购物车
Route::resource("/home_cart","Home\CartController");
// 购物车减
Route::get("/cart_minus/{id}","Home\CartController@minus");
// 购物车加
Route::get("/cart_add/{id}","Home\CartController@add");
// 注册页面(邮箱注册)
Route::resource("/homeregister","Home\RegisterController");
// 发字符串邮件
Route::get("/sendmail","Home\RegisterController@send_mail");
// 发纯文本视图邮件
Route::get("/sendmail2","Home\RegisterController@send_mail2");

// 激活
Route::get("/jihuo","Home\RegisterController@jihuo");

// 验证码测试
Route::get("/code","Home\RegisterController@code");

// 手机号码注册(调用短信接口)
Route::resource("/phone_register","Home\phone_RegisterController");
// 注册跳转
Route::post("/homeregisters","Home\phone_RegisterController@homeregisters");
// Ajax查看手机号是否存在
Route::get("/check_phone","Home\phone_RegisterController@checkphone");
// 发送短信验证码
Route::get("/send_phone","Home\phone_RegisterController@sendphone");
// 验证校验码
Route::get("/check_code","Home\phone_RegisterController@checkcode");

// Redis 测试
Route::get("/redis_test","Home\IndexController@redis");



