<div class="col-md-6">

  <div class="form-group">
    <label for="sizes" class="col-md-3">Size Sort</label>
    <div class="col-md-9">
    	{!!Form::select('size_id',$size,$product->size_id,['class'=>'form-control', 'placeholder'=>'Size Sort'])!!}
    </div>
  </div>


  <div class="form-group">
    <label for="sizes" class="col-md-3">Size </label>
    <div class="col-md-9">
    	{!!Form::text('size',$product->size,['class'=>'form-control', 'placeholder'=>'Size'])!!}
    </div>
  </div>


</div>

<div class="col-md-6">
	
  <div class="form-group">
    <label for="weights" class="col-md-3">weight Sort</label>
    <div class="col-md-9">
    	{!!Form::select('weight_id',$weight,$product->weight_id,['class'=>'form-control', 'placeholder'=>'weight Sort'])!!}
    </div>
  </div>


  <div class="form-group">
    <label for="weights" class="col-md-3">weight </label>
    <div class="col-md-9">
    	{!!Form::text('weights',$product->weight,['class'=>'form-control', 'placeholder'=>'weight'])!!}
    </div>
  </div>


</div>