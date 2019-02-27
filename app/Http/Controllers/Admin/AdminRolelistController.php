<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminRolelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取角色信息
        $role=DB::table('role')->get();
        return view("Admin.Rolelist.index",['role'=>$role]);
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
    // 分配权限
    public function auth($rid){
        // echo "this is auth";
        // 获取当前对应的角色信息
        $role=DB::table("role")->where("id",'=',$rid)->first();
        // dd($role);
        // 获取所有的权限
        $auth=DB::table("node")->get();
        // dd($auth);
        // 获取当前角色已有的权限信息(nids)
        $data=DB::table("role_node")->where("rid","=",$rid)->get();
        // dd($data);
        // 如果该角色有权限
        if(count($data)){
            foreach($data as $v){
                $nids[]=$v->nid;
            }
            return view("Admin.Rolelist.auth",['role'=>$role,'auth'=>$auth,'nids'=>$nids]);            
        // 如果该角色没有权限
        }else{
            return view("Admin.Rolelist.auth",['role'=>$role,'auth'=>$auth,'nids'=>array()]);
        }
    }
    // 保存权限
    public function saveauth(Request $request){
        // echo "this is saveath";
        // dd($request->all());
        // 获取角色id
        $rid=$request->input('rid');
        // 获取分配权限信息(id)
        $nids=$request->input('nids');
        // dd($rid,$nids);
        // 先删除当前角色已有的权限信息
        DB::table("role_node")->where("rid","=",$rid)->delete();
        // 遍历
        if(!empty($nids)){            
            foreach($nids as $v){
                // 封装需要插入的数据
                $data['rid']=$rid;
                $data['nid']=$v;
                // 插入
                DB::table("role_node")->insert($data);
            }
        }
        return redirect("/rolelist")->with("success","权限分配成功");

    }
}
