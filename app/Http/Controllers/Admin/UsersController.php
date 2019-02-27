<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入DB
use DB;
//引入Hash
use Hash;
//导入表单请求校验类
use App\Http\Requests\AdminUserinsert;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //用户列表
    public function index(Request $request)
    {
        /*//获取搜索的关键词
        $k=$request->input("keywords");
        //获取搜索关键词2
        $k1=$request->input('keywordss');
        //获取数据
        $user=DB::table("users")->where("username",'like',"%".$k."%")->where("email",'like',"%".$k1."%")->paginate(3);*/

        /*** Ajax分页***/
        // 统计数据条数
        $total=DB::table("users")->count();
        // 每页显示行数
        $num=2;
        // 最大页数
        $maxpage=ceil($total/$num);
        // dd($maxpage);
        // 获取ajax传过来的分页参数
        $page=$request->input('page');
        if(empty($page)){
            $page=1;
        }
        $offset=($page-1)*$num;
        // 执行sql
        $data=DB::select("select * from users limit $offset,$num");        
        // 判断请求是否为ajax请求
        if($request->ajax()){
            // echo $page;die;
            return view("Admin.Users.ajax_page",['data'=>$data]);
        }
        $pages=array();
        // 遍历
        for($i=1;$i<=$maxpage;$i++){
            $pages[$i]=$i;
        }
        // dd($pages);
        //加载模板
        return view("Admin.Users.index",['pages'=>$pages,'data'=>$data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //用户添加
    public function create()
    {
        // echo "this is user add";
        //加载添加模板
        return view("Admin.Users.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //用创建好的AdminUserinsert表单请求校验类  约束请求对象
    public function store(AdminUserinsert $request)
    {
        //获取所有参数
        // dd($request->all());
        //获取需要入库的参数
        $data=$request->except(['repassword','_token']);
        //密码加密 哈希加密算法 相对比md5加密要严格和安全些
        $data['password']=Hash::make($data['password']);
        //封装status和token
        $data['status']=1;
        $data['token']=str_random(50);
        // dd($data);

        //执行添加
        if(DB::table("users")->insert($data)){
            //数据添加成功的同时 设置session信息 with把所有参数写入到闪存里
            return redirect("/adminusers")->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
        // echo $id;
        //获取需要修改数据
        $user=DB::table("users")->where("id",'=',$id)->first();
        //加载模板 分配数据
        return view("Admin.Users.edit",['user'=>$user]);
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
        // echo $id;
        //获取修改后的数据
        // dd($request->all());
        //封装修改的数据
        $data=$request->except(['_token','_method']);
        // dd($data);
        //执行修改
        if(DB::table("users")->where("id",'=',$id)->update($data)){
            return redirect("/adminusers")->with("success","修改成功");
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
        // echo $id;
        //执行删除
        if(DB::table("users")->where("id",'=',$id)->delete()){
            return redirect("/adminusers")->with('success','删除成功');
        }else{
            return redirect("/adminusers")->with('error','删除失败');
        }
    }

    public function del(Request $request){
        //获取参数id
        $id=$request->input('id');
        // echo $id;
        //执行删除
        if(DB::table("users")->where("id",'=',$id)->delete()){
            echo 1;
        }
    }
}
