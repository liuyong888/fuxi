@extends("Home.HomePublic.Public")
@section("title","产品详情")
@section("main")
<html>
<head>
  <meta charset="utf-8">
  <title>前台详情页</title>
</head>
<body>
<form action="/home_cart" method="post">
  <div style="width:400px;height:400px;background-color:orange;float:left;margin-left:100px"><img src="" width="100%"></div>
  <div style="width:400px;height:400px;background-color:green;float:left;margin-left:100px">
    <h4>名字:{{$info->name}}</h4>
    <h4>价格:{{$info->price}}</h4>
    <h4>数量:<input type="text" name="num" value=""></h4>
    <input type="hidden" name="id" value="{{$info->id}}">
    <input type="hidden" name="name" value="{{$info->name}}">
    <input type="hidden" name="price" value="{{$info->price}}">
    {{csrf_field()}}
    <h4><input type="submit" class="btn btn-success" value="加入购物车"></h4>
  </div>
   </form> 
</body>
</html>
@endsection