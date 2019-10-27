<div id="Product_Settings" class="tab-pane fade">
  <h3>Product Settings</h3>
    <div class="col-sm-3 col-xs-12">
	    {!!Form::label('price','Price')!!}
	    {!!Form::text('price',$Product->price,['class'=>'form-control'])!!}
    </div>

    <div class="col-sm-3 col-xs-12">
	    {!!Form::label('stock','Stock')!!}
	    {!!Form::text('stock',$Product->stock,['class'=>'form-control'])!!}
    </div>

    
    <div class="col-sm-3 col-xs-12">
	    {!!Form::label('start_at','Start At')!!}
	    {!!Form::text('start_at',$Product->start_at,['class'=>'form-control datepicker'])!!}
    </div>

    <div class="col-sm-3 col-xs-12">
	    {!!Form::label('end_at','End At')!!}
	    {!!Form::text('end_at',$Product->end_at,['class'=>'form-control datepicker'])!!}
    </div>

    <div class="clearfix"></div>
<hr style="border-color: black" />

    <div class="col-sm-4 col-xs-12">
	    {!!Form::label('price_offer','Price Offer')!!}
	    {!!Form::text('price_offer',$Product->price_offer,['class'=>'form-control'])!!}
    </div>


    <div class=" col-md-4 col-sm-12">
	    {!!Form::label('start_offer_at','Start Offer At')!!}
	    {!!Form::text('start_offer_at',$Product->start_offer_at,['class'=>'form-control datepicker'])!!}
    </div>

    <div class=" col-md-4 col-sm-12">
	    {!!Form::label('end_offer_at','End Offer At')!!}
	    {!!Form::text('end_offer_at',$Product->end_offer_at,['class'=>'form-control datepicker'])!!}
    </div>



    <div class="clearfix"></div>
<hr style="border-color: black" />
    <div>
	    {!!Form::label('status','status')!!}
	    {!!Form::select('status',['panding'=>'Panding','refused'=>'Refused','active'=>'Active'],$Product->status,['class'=>'form-control'])!!}
    </div>

    <div  class="reason  hidden">
	    {!!Form::label('reason','Reason')!!}
	    {!!Form::textarea('reason',$Product->reason,['class'=>'form-control'])!!}
    </div>


</div>


@push('js')
<script type="text/javascript">
	$('.datepicker').datepicker({
		language:'en',
		format:'yyyy-mm-dd',
		autoclose:false,
		todayBtn:true,
		clearBtn:true
	});

	$(document).ready(function(){
		$(document).on('change','#status',function(){
			var status = $('#status').val();
			if(status!=='refused')
				{
					$('.reason').addClass('hidden');
				}else{
					$('.reason').removeClass('hidden');
				}
		});
	});
</script>
@endpush
