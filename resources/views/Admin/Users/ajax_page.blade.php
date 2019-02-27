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