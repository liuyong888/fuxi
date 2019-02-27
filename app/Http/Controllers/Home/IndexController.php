<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //无限分类递归数据遍历
    public static function getcatesbypid($pid){
        $cate=DB::table("cates")->where("pid",'=',$pid)->get();
        $data=[];
        //遍历
        foreach($cate as $key=>$value){
            //获取当前分类下的所有子类信息
            $value->suv=self::getcatesbypid($value->id);
            $data[]=$value;
        }
        return $data;
    } 
    public function index()
    {
        //获取顶级分类下的所有子类信息
        $cate=self::getcatesbypid(0);
        // dd($cate);
        //加载前台首页模板
        return view("Home.Index.index",['cate'=>$cate]);
        // 顶级分类
        // [
        //     'id'=>118,
        //     'name'=>'手机',
        //     'pid'=>'0',
        //     'suv'=>[
        //                 一级分类
        //                 [
        //                     'id'=>119,
        //                     'name'=>'华为',
        //                     'pid'=>118,
        //                     'suv'=>[
        //                                 二级分类
        //                                 [
        //                                     'id'=>120,
        //                                     'name'=>'华为x1',
        //                                     'pid'=>119,
        //                                     'suv'=>[
        //                                                 三级分类
        //                                                 [
        //                                                     'id'=>121,
        //                                                     'name'=>'华为x11',
        //                                                     'pid'=>120,
        //                                                     'suv'=>[四级分类...]
        //                                                 ]
        //                                             ]
        //                                 ]
        //                             ]
        //                 ]
        //             ]
        // ]
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
}
