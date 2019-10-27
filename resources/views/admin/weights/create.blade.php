@extends('admin.index')
@section('content')
<div class="box"> 
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['url'=>aurl('weights'),'files'=>true])!!}
   <div>
    {!!Form::label('name','Name')!!}
    {!!Form::text('name',old('name'),['class'=>'form-control'])!!}
  </div>


   {!!Form::submit('send',['class'=>'btn btn-primary'])!!}
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





