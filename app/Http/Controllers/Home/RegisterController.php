<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
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
        // 加载注册模板
        return view("Home.Register.register");
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
        // dd($request->all(),$vcode);
        // 获取session校验码
        $vcode=session('vcode');
        // 获取用户输入校验码
        $code=$request->input('code');
        // 对比
        if($code==$vcode){
            if($request->input('password')==$request->input('repassword')){
                $request->except(['repassword','code']);
                $data['email']=$request->input('username');
                $data['password']=Hash::make($request->input('password'));
                $data['status']=0;//0代表未激活
                $data['token']=rand(1,10000);
                // dd($data);
                // 获取插入数据的id
                $id=DB::table('users')->insertGetId($data);
                if($id){
                    // echo 'ok';
                    $res=self::send_mail3($data['email'],$id,$data['token']);
                    if($res){
                        echo "激活用户邮件已发送完成,请立即登录邮箱激活";
                    }
                }
            }else{
                return back()->with("error","两次密码不一致!");                
            }
        }else{
            return back()->with("error","验证码有误！");
        }
    }
    // 用户激活
    public function send_mail3($email,$id,$token){
        Mail::send('Home.Register.jihuo',['id'=>$id,'token'=>$token],function($message)use($email){
            $message->to("$email");
            $message->subject('用户激活');
        });
        return true;
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
    // 字符串 (测试)
    public function send_mail(){
        // echo "yes";
        Mail::raw("this is a mail test",function($message){
            // 接收方
            $message->to('liuyong_0556@qq.com');
            // 发送邮件主题
            $message->subject('test');
        });
    }
    // 纯文本视图 (测试)
    public function send_mail2(){
        Mail::send('Home.Register.a',['id'=>10],function($message){
            $message->to('liuyong_0556@qq.com');
            $message->subject('jihuo');
        });
    }

    // 激活
    public function jihuo(Request $request){
        $id=$request->input('id');
        $token=$request->input('token');
        // token验证
        $info=DB::table('users')->where('id','=',$id)->first();
        if($token==$info->token){
            // 修改状态并重新赋值token
            $data['status']=2;
            $data['token']=rand(1,10000);
            if(DB::table('users')->where('id','=',$id)->update($data)){
                echo "用户已激活,请登录!";
            }

       }
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
        // die;
    } 
}
 