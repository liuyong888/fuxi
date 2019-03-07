<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $cate=IndexController::getcatesbypid(0);
        //购物车页面
        // dd(session('cart'));
        $cart=session('cart');
        // 获取加入购物车的id 并查询
        $data1=array();
        $total=0;//总价
        if(!empty($cart)){            
            foreach($cart as $k=>$v){
                $row=DB::table("goods")->where('id','=',$v['id'])->first();
                $data['id']=$row->id;
                $data['name']=$row->name;
                $data['num']=$v['num'];
                $data['price']=$row->price;
                $data['pic']=$row->pic;
                $data['descr']=$row->descr;
                $total+=$data['num']*$data['price'];
                $data1[]=$data;
            }
        }
        // dd($data1);
        // 加载购物车模块
        return view("Home.Cart.index",['cart'=>$data1,'cate'=>$cate,'total'=>$total]);
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
    // 购物车去重
    public function exceptExists($id){
        $goods=session('cart');
        if(empty($goods)) return false;

        // 对比查看是否添加重复商品
        foreach($goods as $k=>$v){            
            if($v['id']==$id){
                return true;
            }            
        }
    }
    // 加入购物车
    public function store(Request $request)
    {
        $data=$request->except("_token");
        if(!$this->exceptExists($data['id'])){
            //加入购物车存储在session
            // dd($request->all());
            $request->session()->push('cart',$data);
        }
        return redirect("/home_cart");
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
        $data=session("cart");
        foreach($data as $k=>$v){
            if($v['id']==$id){
                // 删除
                unset($data[$k]);
            }
        }
        session(['cart'=>$data]);
        return redirect("home_cart");
    }

    // 购物车数量减
    public function minus($id){
        // echo "加减".$id;
        $data=session('cart');
        foreach($data as $k=>$v){
            if($v['id']==$id){
                $s=$v['num']-1;
                $data[$k]['num']=$s;
                if($data[$k]['num']<1){
                    $data[$k]['num']=1;
                }
            }
        }
        // 修改完数据后重新赋值session
        // session('cart')=$data;
        session(['cart'=>$data]);
        return redirect("/home_cart");
    }
    // 购物车数量加
    public function add($id){
        // echo "加减".$id;
        $data=session('cart');
        foreach($data as $k=>$v){
            if($v['id']==$id){
                $s=$v['num']+1;
                $data[$k]['num']=$s;
                if($data[$k]['num']>5){
                    $data[$k]['num']=5;
                }
            }
        }
        // 修改完数据后重新赋值session
        // session('cart')=$data;
        session(['cart'=>$data]);
        return redirect("/home_cart");
    }
}
