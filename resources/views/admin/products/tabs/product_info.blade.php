<div id="Product_Info" class="tab-pane fade in active">
  <h3>Product Info</h3>
    <div>
    	{!!Form::label('title','Title')!!}
    	{!!Form::text('title',$Product->title,['class'=>'form-control'])!!}
    </div>
    <div>
    	{!!Form::label('content','Content')!!}
    	{!!Form::textarea('content',$Product->content,['class'=>'form-control'])!!}
    </div>
</div>