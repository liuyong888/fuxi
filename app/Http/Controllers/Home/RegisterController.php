<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Mail;
// 导入第三方类库
use Gregwar\Captcha\CaptchaBuilder;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo 123;
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
    // 字符串
    public function send_mail(){
        // echo "yes";
        Mail::raw("this is a mail test",function($message){
            // 接收方
            $message->to('liuyong_0556@qq.com');
            // 发送邮件主题
            $message->subject('test');
        });
    }
    // 纯文本视图
    public function send_mail2(){
        Mail::send('Home.Register.a',['id'=>10],function($message){
            $message->to('liuyong_0556@qq.com');
            $message->subject('jihuo');
        });
    }

    // 激活
    public function jihuo(Request $request){
        echo "this is jihuo ".$request->input('id');
    }
    
    // 引入验证码
    public function code(){
        // 生成校验码代码
        ob_clean();//清除操作
        $builder= new CaptchaBuilder;
        // 可以设置图片的宽高及字体
        $builder->build($width = 100,$height = 40,$font = null);
        // 获取验证码内容
        $phrase=$builder->getPhrase();
        //把内容存入session
        session(['vcode'=>$phrase]);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        //输出校验码
        $builder->output();
        die;
    } 
}
 