<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del{{$id}}"><i class="fa fa-trash"></i></button>

<!-- Modal -->
<div id="del{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete {{$color_name}}</h4>
      </div>
 	  {!! Form::open(['route'=>['colors.destroy',$id],'method'=>'delete'])!!}
      <div class="modal-body">
        <p>Do You Agree To Delete {{$color_name}}</p>
      </div>
      <div class="modal-footer">
        {!!Form::submit('Delete',['class'=>"btn btn-danger",'style'=>'width:16%'])!!}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      {!!Form::close()!!}
    </div>

  </div>
</div>
