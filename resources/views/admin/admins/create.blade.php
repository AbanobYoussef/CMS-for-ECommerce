@extends('admin.index')
@section('content')

<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['url'=>aurl('admin')])!!}
  <div>
    {!!Form::label('name','Admin Name')!!}
    {!!Form::text('name',old('name'),['class'=>'form-control'])!!}
  </div>
  <div>
    {!!Form::label('email','Admin email')!!}
    {!!Form::email('email',old('email'),['class'=>'form-control'])!!}
  </div>
  <div style="margin-bottom: .5%">
    {!!Form::label('password','Admin password')!!}
    {!!Form::password('password',['class'=>'form-control'])!!}
  </div>
   {!!Form::submit('send',['class'=>'btn btn-primary'])!!}
   {!!Form::close()!!}
 </div>    <!-- /.box-body -->
</div>





@endsection



