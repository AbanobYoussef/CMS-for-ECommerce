@extends('admin.index')
@section('content')


<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 <div class="box-body">
  <div style="margin-bottom: 1%">
 <a href="" class="btn btn-info edit_dep showbtn_control hidden"><i class="fa fa-edit"> Edit</i></a>
 <button type="button" class="btn btn-danger del_dep showbtn_control hidden" data-toggle="modal" data-target="#del"><i class="fa fa-trash"></i> Delete</button>
</div>

  <div id="jstree"></div>
 </div>    <!-- /.box-body -->
</div>



@endsection


@push('js')
<script type="text/javascript">
  $(document).ready(function(){

            $('#jstree').jstree({
          "core" : {
            'data' : {!!  load_dep()!!},
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

            var i , j , r=[],name=[];

            for (i = 0, j=data.selected.length; i<j; i++) {
              r.push(data.instance.get_node(data.selected[i]).id);
              name.push(data.instance.get_node(data.selected[i]).text);
            }
            $('#del_form').attr('action','{{aurl('departments')}}/'+r.join(', '));
            $('#dep_name').text(name.join(', '));
            if(r.join(', ')!='')
            {

              $('.showbtn_control').removeClass('hidden');
              $('.edit_dep').attr('href','{{aurl('departments')}}/'+r.join(', ')+'/edit');


            }else
            {
              $('.showbtn_control').hadClass('hidden');
            }
        });
</script>


<!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="del" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete </h4>
      </div>
    {!! Form::open(['url'=>'','method'=>'delete','id'=>'del_form'])!!}
      <div class="modal-body">
        <p>Do You Agree To Delete <span id="dep_name"></span></p>
      </div>
      <div class="modal-footer">
        {!!Form::submit('Delete',['class'=>"btn btn-danger",'style'=>'width:16%'])!!}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      {!!Form::close()!!}
    </div>

  </div>
</div>

@endpush




