<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//导入Hash
use Hash;
//导入模型类到控制器里
use App\Models\User;
//导入DB；
use DB;
//导入类A
use A;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //通过控制器调度模型
        $data=User::paginate(3);
        //加载模板
        return view("Admin.User.index",['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加模板
        return view("Admin.User.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //封装需要插入的数据
        $data=$request->except(['repassword','_token']);
        //密码加密
        $data['password']=Hash::make($data['password']);
        // dd($data);
        $data['status']=1;
        $data['token']=str_random(50);
        if(User::create($data)){
            return redirect("/adminuser")->with('success','添加ok');
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
        //获取会员详情信息
        // echo $id;
        $userinfo=User::find($id)->info;
        //加载会员详情列表
        return view("Admin.User.userinfo",['userinfo'=>$userinfo]);
    }

    //获取会员收货地址
    public function address($id){
        // echo $id;
        $address=User::find($id)->address;
        //加载模板 分配数据
        return view("Admin.User.address",['address'=>$address]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取需要修改数据
        $user=User::find($id);
        //加载修改模板
        return view("Admin.User.edit",['user'=>$user]);
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
        //封装需要修改的数据
        $data=$request->except(['_token','_method']);
        if(User::where("id",'=',$id)->update($data)){
            return redirect("/adminuser")->with('success','修改成功');
        }
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
        // echo $id;
        if(User::destroy($id)){
            return redirect("/adminuser")->with('success','删除成功');
        }
    }

    public function user(){
        //操作数据表
        $data=DB::table("users")->get();
        dd($data);
    }

    //调用自定义函数
    public function users(){
        pay();
        
    }

    //调用自定义类 A
    public function c(){
        //实例化类A
        $a=new A();
        $a->sendmessage();
    }

    public function p(){
        sendphone(18235148650);

    }

    public function pay(){
        pays(time()+rand(1,10000),'手机','0.01','锤子');
        
    }

    public function returnurl(){
        echo "付款成功";
    }
}
