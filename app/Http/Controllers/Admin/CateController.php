<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getCates(){
         $cate=DB::table("cates")
                    ->select(DB::raw('*,concat(path,id)as paths'))
                    ->orderBy('paths')
                    ->get();
        //加分隔符
        foreach($cate as $key=>$value){
            // echo $value->path."<br>";
            //把path字符串转换为数组
            $arr=explode(",",$value->path);
            // dd($arr);
            // echo "<pre>";
            // var_dump($arr);
            //获取逗号个数
            $len=count($arr)-1;
            //重复字符串函数
            $cate[$key]->name=str_repeat("--|",$len).$value->name;
        }
        return $cate;
    }
    public function index(Request $request)
    {
        //获取类别数据
        // $cate=DB::table("cates")->get();
        // $cate=DB::select("select *,concat(path,id)as paths from cates order by paths");
        //获取搜索条件
        $k=$request->input('keywords');
        //转换为连贯方法
        $cate=DB::table("cates")
                    ->select(DB::raw('*,concat(path,id)as paths'))
                    ->orderBy('paths')->where('name','like',"%".$k."%")
                    ->paginate(3);
        //加分隔符
        foreach($cate as $key=>$value){
            // echo $value->path."<br>";
            //把path字符串转换为数组
            $arr=explode(",",$value->path);
            // dd($arr);
            // echo "<pre>";
            // var_dump($arr);
            //获取逗号个数
            $len=count($arr)-1;
            //重复字符串函数
            $cate[$key]->name=str_repeat("--|",$len).$value->name;
        }

        // dd($cate);
        //加载模板 分配数据
        return view("Admin.Cate.index",['cate'=>$cate,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取所有的分类信息
        $cate=DB::table("cates")->get();
        //加载添加模板
        return view("Admin.Cate.add",['cate'=>$cate]);
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
        $data=$request->except('_token');
        $pid=$request->input('pid');
        // dd($data);
        //判断
        if($pid==0){
            //添加的是顶级分类
            // dd($data);
            //拼接path
            $data['path']='0';
        }else{
            //添加的是子类
            // dd($data);
            //拼接path  父类 path.父类的id
            //获取父类的信息
            $info=DB::table("cates")->where("id",'=',$pid)->first();
            $data['path']=$info->path.",".$info->id;

        }

        //入库
        if(DB::table("cates")->insert($data)){
            echo 1;
        }else{
            echo 0;
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
        // echo $id;
        //获取当前类别下子类个数

        $res=DB::table("cates")->where("pid",'=',$id)->count();
        // echo $res;
        //当前类别下有子类信息 不能直接删除
        if($res>0){
            return redirect("/admincates")->with('error','请先干掉孩子');
        }
        //当前类别下没有子类信息 直接删除
        if(DB::table("cates")->where("id",'=',$id)->delete()){
            return redirect("/admincates")->with('success','删除成功');
        }
    }
}
