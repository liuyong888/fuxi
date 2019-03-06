<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Mail;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //登录之前先销毁用户 
        $request->session()->pull('email');
        //获取分类的数据给模板
        $cate=IndexController::getcatesbypid(0);
        //加载登录模板
        return view("Home.Login.index",['cate'=>$cate]);
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
                    // echo "登录成功!";  
                    session(['email'=>$email]);
                    return redirect("/homeindex");                                    
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
    public function do_forget(Request $request){
        // dd($request->all());
        // 发送邮件 重置密码
        $email=$request->input('email');
        $info=DB::table('users')->where('email','=',$email)->first();
        $id=$info->id;
        $token=$info->token;
        if(self::send_mail($email,$id,$token)){
            echo "重置密码邮件发送成功,请立即前往该邮箱";            
        }else{
            echo "输入邮箱有误!";
        }
    }

    // 发送邮件
    public function send_mail($email,$id,$token){
        Mail::send('Home.Login.reset_pwd',['email'=>$email,'id'=>$id,'token'=>$token],function($message)use($email){
            $message->to("$email");
            $message->subject("重置密码");
        });
        return true;
    }

    // 加载重置密码视图
    public function reset_pwd_view(Request $request){
        $id=$request->input('id');
        $info=DB::table('users')->where('id','=',$id)->first();
        // 对比邮件token和数据表的token
        $token=$request->input('token');
        if($info->token==$token){            
            return view("Home.Login.reset_pwd_view",['id'=>$id]);
        }else{
            echo "数据异常,加载失败!";
        }
    } 
    // 修改密码
    public function update_pwd(Request $request){
        // dd($request->all());
        $password=trim($request->input('password'));
        $repassword=trim($request->input('repassword'));

        if($password=='' || $repassword==''){
            return back()->with("error","不能为空值或空格!");
        }
        
        if($password == $repassword){
            $data['token']=rand(1,10000);
            $data['password']=Hash::make($password);
            if(DB::table("users")->where('id','=',$request->input('id'))->update($data)){
                return redirect("/login");
            }
        }else{
            return back()->with("error","两次密码不一致!");
        }           
    }
}
