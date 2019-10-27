@extends('admin.index')
@section('content')

<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['route'=>['size.update',$size->id],'method'=>'put'])!!}
   <div>
    {!!Form::label('name','Name')!!}
    {!!Form::text('name',$size->name,['class'=>'form-control'])!!}
  </div>

  <div id="jstree"></div>
  <input type="hidden" name="department_id" class="department_id" value="{{old('department_id')}}">

  <div>
    {!!Form::label('is_public','State')!!}
    {!!Form::select('is_public',['yes'=>'Yes','no'=>'No'],$size->is_public,['class'=>'form-control'])!!}
  </div>

   {!!Form::submit('save',['class'=>'btn btn-primary'])!!}
   {!!Form::close()!!}
 </div>    <!-- /.box-body -->
</div>



<style>
  div
  {
    margin-bottom: 1%
  }
</style>

@endsection

@push('js')
<script type="text/javascript">
  $(document).ready(function(){

            $('#jstree').jstree({
          "core" : {
            'data' : {!!  load_dep($size->department_id)!!},
            "themes" : {
              "variant" : "large"
            }
          },
          "checkbox" : {
            "keep_selected_style" : true
          },
          "plugins" : [ "wholerow"]
        });

  });


  $('#jstree').on('changed.jstree',function(e,data){

            var i , j , r=[];

            for (i = 0, j=data.selected.length; i<j; i++) {
              r.push(data.instance.get_node(data.selected[i]).id);
            }
            if(r.join(', ')!='')
            {
              $('.department_id').val(r.join(', '));
            }
        });


</script>


@endpush




