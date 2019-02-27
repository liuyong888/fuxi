@extends("Admin.AdminPublic.publics")
@section('admin')
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>公告列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">     
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">操作</th>
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">标题</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">内容</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $row)
       <tr class="odd"> 
        <td class=""><input type="checkbox" name="" value="{{$row->id}}"></td>
        <td class=" ">{{$row->id}}</td> 
        <td class=" ">{{$row->title}}</td> 
        <td class=" ">{{$row->desc}}</td>         
       </tr>
       @endforeach
       <tr>
         <td colspan="4">
            <a href="javascript:void(0)" class="btn btn-success allchoose">全选</a>
            <a href="javascript:void(0)" class="btn btn-success nochoose">全不选</a>
            <a href="javascript:void(0)" class="btn btn-success fchoose">反选</a>
            <a href="javascript:void(0)" class="btn btn-danger del">删除</a>
         </td>
       </tr>
      </tbody>
     </table>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
     </div>
    </div> 
   </div> 
  </div>
 </body> 
</html>
<script>
  // 全选
  $(".allchoose").click(function(){
    // 获取table所有的tr 遍历
    $("#DataTables_Table_1").find("tr").each(function(){
      // 找到tr下的复选框 选中数据
      $(this).find(":checkbox").attr("checked",true);
    });
  });
  // 全不选
  $(".nochoose").click(function(){
    // 获取table所有的tr 遍历
    $("#DataTables_Table_1").find("tr").each(function(){
      // 找到tr下的复选框 不选中数据
      $(this).find(":checkbox").attr("checked",false);
    });
  });
  // 反选
  $(".fchoose").click(function(){
    // 
    $("#DataTables_Table_1").find("tr").each(function(){
      if($(this).find(":checkbox").attr("checked")){
        $(this).find(":checkbox").attr("checked",false);
      }else{
        $(this).find(":checkbox").attr("checked",true);
      }
    });
  });
  // 删除按钮
  $(".del").click(function(){
    arr=[];
    // 遍历所有的复选框
    $(":checkbox").each(function(){
      if($(this).attr("checked")){
        // 选中的id
        var id=$(this).val();
        // alert(id);
        arr.push(id);
      }
    });
    // alert(arr);
    $.get("articledel_ajax",{id:arr},function(result){
      // alert(result);
      // 找到删除数据的tr直接remove
      if(result==1){
        // 遍历
        for(var i=0;i<arr.length;i++){
          $("input[value='"+arr[i]+"']").parents("tr").remove();
        }
      }else{
        alert(result);
      }
    });
  });
</script>
@endsection
@section('title','公告列表')