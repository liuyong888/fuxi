<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //加载登录模板
        return view("Home.Login.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $email=$request->input('email');
        $password=$request->input('password');
        $info=DB::table('users')->where(['email'=>$email])->first();
        // dd($info);
        if($info){
            // echo "登录成功!";
            if(Hash::check($password,$info->password)){
                if($info->status==2){
                    echo "登录成功!";                                        
                }else{
                    return back()->with("error","请先激活用户!");                    
                }
            }else{
            return back()->with("error","密码错误!");                
            }
        }else{
            return back()->with("error","用户不存在!");            
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

    // 忘记密码
    public function forget(){
        return view("Home.Login.forget");
    }
    // 找回密码 (发送重置邮件)
    public function get_new_pwd(Request $request){
        // dd($request->all());
        // 发送邮件 重置密码
        
    }
    // 重置密码
    public function reset_pwd(){
        
    } 
}
