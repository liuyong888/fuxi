<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Config;

class AdminGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=DB::table('goods')
                    ->join("cates","cates.id","=","goods.typeid")
                    ->select("goods.*","cates.id as cid","cates.name as cname")
                    ->get();
                    // dd($data);
        return view("Admin.Goods.index",['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //调用CateController获取商品分类
        $cate=CateController::getCates();
        // dd($cate);
        return view("Admin.Goods.add",['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data=$request->except("_token");
        $data['xiaoliang']=0;
        $data['company']="深圳华为科技";
        // 图片上传
        if($request->hasFile("pic")){
            // 初始化名字
            $name=time()+rand(1,1000);
            // 获取后缀
            $ext=$request->file("pic")->getClientOriginalExtension();
            // 把上传的图片移动到指定的目录下
            $request->file("pic")->move(Config::get('app.uploads'),$name.".".$ext);
            $data['pic']=trim(Config::get('app.uploads')."/".$name.".".$ext,'.');
        }
        $data['status']=0;
        // dd($data);
        // 入库
        if(DB::table("goods")->insert($data)){
            return redirect("/admingoods")->with("success","添加成功");
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
        // dd($id);
        $info=DB::table("goods")->where("id","=",$id)->first();
        // dd($info);
        if(DB::table("goods")->where("id","=",$id)->delete()){
            if(unlink(".".$info->pic)){
                return redirect("/admingoods")->with("success","删除成功");
            }
                return redirect("/admingoods")->with("success","删除成功");            
        }else{
            return redirect("/admingoods")->with("error","删除失败");
        }

    }
}
