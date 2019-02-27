@extends("Admin.AdminPublic.publics")
@section('admin')
<div class="container">                                      
<div class="container"> 
    <div class="mws-panel-body no-padding"> 
     <form class="mws-form" action="/saveauth" method="post"> 
      <div class="mws-form-inline"> 
       <div class="mws-form-row"> 
        <label class="mws-form-label">权限信息</label> 
        <div class="mws-form-item clearfix"> 
         <h4>当前角色: {{$role->name}}_的角色信息</h4> 
         <ul class="mws-form-list inline">
            @foreach($auth as $v)
            <li>
              <input type="checkbox" name="nids[]" value="{{$v->id}}" @if(in_array($v->id,$nids)) checked @endif>
              <label>{{$v->name}}</label>
            </li>
            @endforeach
          </ul> 
        </div> 
       </div> 
      </div> 
      <div class="mws-button-row">     
      <input type="hidden" name="_token" value="rwwHVnSuAD2bOzXJbBUd5wbTITSZtg7HhPvANKb2">  
        {{csrf_field()}} 
        <input type="hidden" name="rid" value="{{$role->id}}">
       <input value="分配权限" class="btn btn-danger" type="submit"> 
       <input value="Reset" class="btn " type="reset"> 
      </div> 
     </form> 
    </div> 
</div>
</div>
@endsection
@section('title','分配权限')