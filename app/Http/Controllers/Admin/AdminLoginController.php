<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //退出
        $request->session()->pull('name');
        $request->session()->pull('nodeList');
        return redirect("/adminlogin/create");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载登录模板
        return view('Admin.AdminLogin.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 登录验证
    public function store(Request $request)
    {
        // dd($request->all());
        $name=$request->input('username');
        $password=$request->input('password');
        $info=DB::table('admin_users')->where('name','=',$name)->first();
        if($info){
            if(Hash::check($password,$info->password)){
                // 登录信息写入session里
                session(['name'=>$name]);
                // 1.获取当前登录用户的所有权限列表
                $list=DB::select("select n.name,n.mname,n.aname from user_role as ur,role_node as rn,node as n where ur.rid=rn.rid and rn.nid=n.id and ur.uid={$info->id}");
                // dd($list);
                // 2.初始化权限列表
                $nodeList['AdminController'][]='index';
                foreach($list as $v){
                    $nodeList[$v->mname][]=$v->aname;
                    if($v->aname=="create"){
                        $nodeList[$v->mname][]="store";                        
                    }
                    if($v->aname=="edit"){
                        $nodeList[$v->mname][]="update";                        
                    }
                }
                // dd($nodeList);                
                // 3.将登陆的用户所有权限列表存储在session里
                session(['nodeList'=>$nodeList]);
                // 4.获取访问模块的控制器和方法 与用户的权限列表作对比
                // 这一步在登录的中间件里操作
                return redirect('/admin')->with('success','登录成功');
            }
        }else{
            return back()->with('error','用户名或密码错误!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
