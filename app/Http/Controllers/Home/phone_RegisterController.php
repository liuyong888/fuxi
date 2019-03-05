<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class phone_RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // echo "this is phone Register!!";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载模板
        return view("Home.Registers.registers");
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

    // 验证手机号码是否存在
    public function checkphone(Request $request){
        $phone=$request->input('p');
        // 获取users表数据 phone 一列数据
        $data=DB::table('users')->pluck('phone');
        // print_r($data);
        $arr=array();
        foreach($data as $k=>$v){
            $arr[$k]=$v;
        }
        // echo json_decode($arr);
        if(in_array($phone,$arr)){
            echo '1';  //1代表已存在
        }else{
            echo '0';  //0代表不存在
        }
    }
    // 发送短信
    public function sendphone(Request $request){
        $p=$request->input('p');
        // echo $p;
        // 调用发送短信方法
        sendphone($p);
    }

    // 用户输入校验码验证
    public function checkcode(Request $request){
        // 用户输入user_code
        $user_code=$request->input('code');
        // echo $user_code;
        // echo $_COOKIE['fcode'];
        if(isset($_COOKIE['fcode']) && !empty($user_code)){
            // 拿存储在cookie里系统验证码
            $fcode=$request->cookie('fcode');
            // 对比验证
            if($fcode==$user_code){
                echo 1; // 输入跟接收的手机验证码一致
            }else{
                echo 0; // 输入有误
            }
        }elseif(empty($user_code)){
            echo 2; // 输入校验码为空
        }else{
            echo 3; // 验证码过期
        }
    }
    // 验证成功
    public function homeregisters(){
        echo "ok";
    }
}
