@extends('admin.index')
@section('content')

<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 <div class="box-body">
 	{!!Form::open(['id'=>'form-data','url'=>aurl('users/destory/all'),'method'=>'delete'])!!}
    {!! $dataTable->table(['class'=>'dataTable table table-striped table-hover table-bordered '],true) !!}
    {!!Form::close()!!}
 </div>    <!-- /.box-body -->
</div>

<div class="modal" id="multiDelete" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <div class="alert alert-danger">
        	<div class="empty_record hidden">
        		<h2 >No recoders Selected</h2>
        	</div>
        	<div class="not_empty_record hidden">
        		<h2 >You Have been Selected <span class="record_count"></span></h2> 
        	</div>
        </div>


      </div>
      <div class="modal-footer">
      	<div class="not_empty_record hidden">
        	<input type="button" class="btn btn-primary del_all" value="yse" />
            <button type="button" class="btn btn-secondary" data-dismiss="modal">no</button>
        </div>
        <div class="empty_record hidden">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        	</div>
      </div>
    </div>
  </div>
</div>

<style>
	#dataTableBuilder input{
		width: 101%;
	}
	#dataTableBuilder_previous{
		background-color: lightgray;
		padding: .5%;
	}
	.current
	{
		background-color: lightblue;
		padding: .5%;
	}

	#dataTableBuilder_next
	{
		background-color: lightgray;
		padding: .5%;
	}



	#dataTableBuilder_previous , .current , #dataTableBuilder_next
	{
		cursor: pointer;
		text-decoration: none;
		color: black
	}
</style>


@endsection

 @push('js')
 <script>delete_all();</script>
{!! $dataTable->scripts() !!}
@endpush


