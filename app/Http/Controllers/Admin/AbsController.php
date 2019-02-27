<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AbsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=DB::table("abs")->get();
        return view("Admin.Abs.index",['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("Admin.Abs.add");
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
        $data=$request->except("_token");
        // dd($data);
        if(DB::table("abs")->insert($data)){
            return redirect("/abs")->with('success','添加成功!');
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
        $info=DB::table('abs')->where('id','=',$id)->first();
        return view('Admin.Abs.edit',['info'=>$info]);
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
        $data=$request->except('_token','_method');
        // dd($data);
        $info=DB::table('abs')->where("id",'=',"$id")->first();
        $str=$info->contents;
        preg_match_all('/<img.*?src="(.*?)".*?>/is',$str,$arr);
        // dd($arr);
        foreach($arr[1] as $k=>$v){
            if(!preg_match("/^(http:\/\/|https:\/\/).*$/",$v)){
                unlink('.'.$v);
            }
        }
        if(DB::table("abs")->where('id','=',$id)->update($data)){
            return redirect("/abs")->with('success','修改成功');
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
        $info=DB::table('abs')->where("id",'=',"$id")->first();
        // <p>哈哈哈</p><p><img src="/ueditor/php/upload/image/20190225/1551074775.png" title="1551074775.png" alt="回跳地址.png" width="194" height="132" style="width: 194px; height: 132px;"/></p>
        $str=$info->contents;
        preg_match_all('/<img.*?src="(.*?)".*?>/is',$str,$arr);
        // dd($arr);
        foreach($arr[1] as $k=>$v){
            if(!preg_match("/^(http:\/\/|https:\/\/).*$/",$v)){
                unlink('.'.$v);
            }
        }
        if(DB::table("abs")->where('id','=',$id)->delete()){
            return redirect("/abs")->with('success','删除成功');
        }
    }
}
