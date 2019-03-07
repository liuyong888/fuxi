@extends("Home.HomePublic.Public")
@section("title","购物车")
@section("main")
<h3>购物车信息</h3>
<table class="table table-bordered table-hover">
  <tr>
    <th>名字</th>
    <th>商品</th>
    <th>数量</th>
    <th>单价</th>
    <th>总计</th>

    <th>操作</th>
  </tr>
  @foreach($cart as $k=>$v)
  <tr>
    <td>{{$v['name']}}</td>
    <td><img src="/static/homes/Goods/{{$v['pic']}}" width="50px" height="50px"></td>
    <td><a href="/cart_minus/{{$v['id']}}" class="btn btn-info">-</a><input type="text" value="{{$v['num']}}"> <a href="/cart_add/{{$v['id']}}" class="btn btn-info">+</a></td>
    <td>{{$v['price']}}元</td>
    <td>{{$v['price']*$v['num']}}元</td>

    <td>
      <form action="/home_cart/{{$v['id']}}" method="post" accept-charset="utf-8">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <input type="submit" class="btn btn-danger" value="删除">        
      </form>
    </td>
  </tr>
  @endforeach
  <tr>
    <td colspan="4"> <a href="/homeindex" class="btn btn-info">继续购买</a></td>
    <td>总计:{{$total}}元</td>
    <td> <input type="submit" value="结算" class="btn btn-info"></td>
  </tr>
</table>
@endsection