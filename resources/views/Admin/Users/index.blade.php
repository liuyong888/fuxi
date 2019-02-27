@extends("Admin.AdminPublic.publics")
@section('admin')
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>用户列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
      <form action="/adminusers" method="get">
     <div class="dataTables_filter" id="DataTables_Table_1_filter">
      <label>用户名: <input type="text" aria-controls="DataTables_Table_1" name="keywords" value="{{$request['keywords'] or ''}}"/>邮箱<input type="text" aria-controls="DataTables_Table_1" name="keywordss" value="{{$request['keywordss'] or ''}}"/></label>
      <input type="submit" class="btn btn-success" value="搜索">
     </div>
     </form>
     <div id="uid">       
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">用户名</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 191px;">邮箱</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 137px;">状态</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 137px;">电话</th>

        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      @foreach($data as $r)
       <tr class="odd"> 
        <td class=" sorting_1">{{$r->id}}</td> 
        <td class=" ">{{$r->username}}</td> 
        <td class=" ">{{$r->email}}</td> 
        <td class=" ">{{$r->status}}</td> 
        <td class=" ">{{$r->phone}}</td> 
        <td class=" ">
          <form action="/adminusers" method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit"  class="btn btn-danger"><i class="icon-trash"></i></button>
          </form>
          <a href="javascript:void(0)" class="btn btn-info del"><i class="icon-remove-sign"></i></a>
          <a href="/adminusers/" class="btn btn-success"><i class="icon-wrench"></i></a>
        </td> 
       </tr>
       @endforeach
      </tbody>
     </table>
    </div>     
    <div class="dataTables_paginate paging_full_numbers" id="pages">
      @foreach($pages as $p)
      <button type="button" class="btn btn-info" onclick="pager({{$p}})">{{$p}}</button>
      @endforeach
     </div>
    </div> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">
 // Ajax分页
 function pager(page){
  // alert(page);
  $.get("/adminusers",{page:page},function(data){
    // alert(data);
    // 给id为uid的div赋值
    $("#uid").html(data);
  });
 }
  // alert($);
  //获取按钮 绑定单击事件
  $(".del").click(function(){
    //获取删除数据的id
    id=$(this).parents("tr").find("td:first").html();
    s=$(this).parents("tr");
    ss=confirm('你确定删除吗?');
    if(ss){
      //Ajax
      $.get("/adminuserdel",{id:id},function(data){
        // alert(data);
        if(data==1){
          // alert("删除成功");
          //把删除数据所在的tr从dom移除  remove()
          s.remove();
        }
      });
    }
  });
 </script>
</html>
@endsection
@section('title','用户列表')