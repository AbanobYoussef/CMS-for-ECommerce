@extends('admin.index')
@section('content')

<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['route'=>['colors.update',$Color->id],'method'=>'put'])!!}
   <div>
    {!!Form::label('color_name','Name')!!}
    {!!Form::text('color_name',$Color->color_name,['class'=>'form-control'])!!}
  </div>


  <div>
    {!!Form::label('email','Email')!!}
    {!!Form::color('color',$Color->color,['class'=>'form-control'])!!}
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




