@extends('admin.index')
@section('content')


<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['url'=>aurl('departments'),'files'=>true])!!}
  <div>
    {!!Form::label('dep_name','Department Name')!!}
    {!!Form::text('dep_name',old('dep_name'),['class'=>'form-control'])!!}
  </div>
<div id="jstree"></div>
<input type="hidden" name="parent" class="parent_id" value="{{old('parent')}}">
  <div style="margin-bottom: 1%">
      {!!Form::label('description','Description')!!}
      {!!Form::textarea('description',old('description'),['class'=>' country_id form-control'])!!}
  </div>

  <div style="margin-bottom: 1%">
      {!!Form::label('keywords','Keywords')!!}
      {!!Form::textarea('keywords',old('keywords'),['class'=>' country_id form-control'])!!}
  </div>

  <div class="form-group">
      {!! Form::label('icon','Flag') !!}
      {!! Form::file('icon',['class'=>'form-control']) !!}
  </div>

   {!!Form::submit('send',['class'=>'btn btn-primary'])!!}
   {!!Form::close()!!}
 </div>    <!-- /.box-body -->


</div>





@endsection


@push('js')
<script type="text/javascript">
  $(document).ready(function(){

            $('#jstree').jstree({
          "core" : {
            'data' : {!!  load_dep(old('parent'))!!},
            "themes" : {
              "variant" : "large"
            }
          },
          "checkbox" : {
            "keep_selected_style" : true
          },
          "plugins" : [ "wholerow"]
        });



        $('#jstree').on('changed.jstree',function(e,data){

            var i , j , r=[];

            for (i = 0, j=data.selected.length; i<j; i++) {
              r.push(data.instance.get_node(data.selected[i]).id);
            }
            $('.parent_id').val(r.join(', '));
        });


  });
</script>




@endpush



