@extends("Home.HomePublic.Public")
@section("title","首页")
@section("main")
<html>
<head>
  <meta charset="utf-8">
  <title>前台首页</title>
</head>
<body>
  <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
   <style type="text/css">
    .mm{
      width:100px;
      height:30px;
      background-color:#ccc;
      text-align:center;
      line-height:30px;
      float:left;
      list-style-type:none;
    }

    .ll{
      width:100px;
      height:30px;
      background-color:orange;
      text-align:center;
      line-height:30px;
      float:left;
      list-style-type:none;
      border-right:1px dashed green;
    }
  </style>
</head>
<body>
@foreach($cate as $row)
 <div style="margin-left:400px">
    <li class="mm">{{$row->name}}</li>
    @foreach($row->suv as $rows)
      <li class="ll" cid="{{$rows->id}}" name="{{$row->id}}">{{$rows->name}}</li>              
    @endforeach
    <div class="uid{{$row->id}}" style="width:400px;height:400px;border:1px solid red"> 
        <!-- <img src="">  -->
    </div>
</div>
@endforeach
</body>
<script>
  // alert($);
  // 获取二级分类ll,绑定鼠标移入事件
  $(".ll").mouseover(function(){
    // v=$(this).html();
    // 获取一级分类的id
    id=$(this).attr('cid');
    // 获取name的属性 (!!! 为每个大的分类做区分 !!!)不同顶级分类的div class不能相同,否则每个大类里ajax追加的数据都一样
    name=$(this).attr('name');
    // Ajax
    $.get("/homeindex",{id:id},function(res){
      // alert(res);
      // 移除当前div下的所有元素
      $(".uid"+name).children().remove();
      console.log(res);
      for(var i=0;i<res.length;i++){
        // 创建img元素
        img=$('<img>');
        img.attr("src","/static/homes/Goods/"+res[i].pic);
        img.attr("width","100px");
        img.attr("height","100px");
        $(".uid"+name).append(img);
      }
    },'json');
  });
</script>
</html>
@endsection