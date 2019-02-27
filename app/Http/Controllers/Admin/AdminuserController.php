<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class AdminuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取管理员管理列表数据
       $adminuser=DB::table('admin_users')->paginate(3);
       // dd($adminuser);
       // 加载模板
       return view("Admin.Adminuser.index",['adminuser'=>$adminuser]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("Admin.Adminuser.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //管理员入库
        // dd($request->all());
        $data=$request->except('_token','repassword');
        // dd($data);
        $data['password']=Hash::make($data['password']);
        // dd($data);
        if(DB::table('admin_users')->insert($data)){
            return redirect("/adminuserss")->with('success','添加成功!');
        }else{
            return back()->with('error','添加失败!');
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

    // 分配角色
    public function role($id){
        // 获取用户信息
        $user=DB::table('admin_users')->where("id",'=',"{$id}")->first();
        // dd($user);
        // 获取所有的角色列表
        $roles=DB::table('role')->get();
        // 获取当前用户的角色信息
        $role=DB::table('user_role')->where('uid','=',$id)->get();
        // dd($role);
        // (1)当前用户有角色信息
        if(count($role)){
            foreach($role as $v){
                $rids[]=$v->rid;
            }
            // 加载模板
            return view("Admin.Adminuser.role",['user'=>$user,'roles'=>$roles,'rids'=>$rids]);
        }else{   
        // (2)当前用户没有角色信息
            return view("Admin.Adminuser.role",['user'=>$user,'roles'=>$roles,'rids'=>array()]);            
        }
    }

    // 保存角色
    public function saverole(Request $request){
        // dd($request->all());
        // 获取角色id(数组)
        $rids=$_POST['rids'];
        // 获取待分配角色的 管理员id
        $uid=$request->input('uid');
        // dd($rids,$uid);
        // 把数据表里用户已有的角色删除掉
        DB::table("user_role")->where("uid","=",$uid)->delete();
        // 分配角色
        foreach($rids as $v){
            $data['uid']=$uid;
            $data['rid']=$v;
            // 插入数据
            DB::table("user_role")->insert($data);
        }
        // 如果重复分配了角色,对用户角色表的重复数据进行删除
       /* DB::delete('DELETE FROM   user_role
                                WHERE
                (uid, rid) IN (
                    SELECT
                        ur.uid,
                        ur.rid
                    FROM
                        (
                            SELECT
                                uid,
                                rid
                            FROM
                                user_role
                            GROUP BY
                                uid,
                                rid
                            HAVING
                                count(1) > 1
                        ) ur
                )
            AND no NOT IN (
                SELECT
                    dt.minno
                FROM
                    (
                        SELECT
                            min(no) AS minno
                        FROM
                            user_role
                        GROUP BY
                            uid,
                            rid
                        HAVING
                            count(1) > 1
                    ) dt
            )
        ');*/
        return redirect("adminuserss")->with("success","角色分配成功");
    }
}
