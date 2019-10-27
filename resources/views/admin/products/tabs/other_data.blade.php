@push('js')
	<script type="text/javascript">
		var x=1;
		$(document).on('click','.add_input',function(){
			var max_input=10;
				if(x<max_input)
				{
					x++;
					$('.div_input').append('<div class="BOX">'+$('.BOX').html()+'</div>');
				}
				return false;
		});

		$(document).on('click','.remove_input',function(){
			   x--;
			   if(x!=0)
			   {
			   	$(this).parent('.BOX').remove();
			   }
			   else
			   {
			   	x=1;
			   }
				return false;
		});
	</script>
@endpush

<div id="More_Info" class="tab-pane fade">
  	 <h3>More Info</h3>

  	 <!-------------------------------------->
	  <div class="col-sm-12 div_input" style="border:2px lightgray solid ; padding: .5%">
	  		@if($Product->other_data()->get())
	  		<div class="BOX">
		  		<div class="col-sm-6">
			  		{!!Form::label('input_key','Key')!!}
			        {!!Form::text('input_key[]','',['class'=>'form-control'])!!}
		  	    </div>

		  	    <div class="col-sm-6">
			  		{!!Form::label('input_value','Value')!!}
			        {!!Form::text('input_value[]','',['class'=>'form-control'])!!}
		     	</div>

			    <div class="clearfix"></div>

			  	<a href="#" class="remove_input btn btn-danger " style="border-radius: 50% "><i class="fa fa-trash"></i></a>
			</div>
	  		@endif
		  	@foreach($Product->other_data()->get() as $other)
		  	<div class="BOX">
		  		<div class="col-sm-6">
			  		{!!Form::label('input_key','Key')!!}
			        {!!Form::text('input_key[]',$other->data_key,['class'=>'form-control'])!!}
		  	    </div>

		  	    <div class="col-sm-6">
			  		{!!Form::label('input_value','Value')!!}
			        {!!Form::text('input_value[]',$other->data_value,['class'=>'form-control'])!!}
		     	</div>

			    <div class="clearfix"></div>

			  	<a href="#" class="remove_input btn btn-danger " style="border-radius: 50% "><i class="fa fa-trash"></i></a>
			</div>
		  	@endforeach

	  </div>
	  <!-------------------------------------->
	  <a href="#" class="add_input btn btn-info align-self-center" style="border-radius: 50% "><i class="fa fa-plus"></i></a>

</div>