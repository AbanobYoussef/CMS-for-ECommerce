@extends('admin.index')
@section('content')

<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['route'=>['admin.update',$admin->id],'method'=>'put'])!!}
  <div>
    {!!Form::label('name','Admin Name')!!}
    {!!Form::text('name',$admin->name,['class'=>'form-control'])!!}
  </div>
  <div>
    {!!Form::label('email','Admin email')!!}
    {!!Form::email('email',$admin->email,['class'=>'form-control'])!!}
  </div>
  <div style="margin-bottom: .5%">
    {!!Form::label('password','Admin password')!!}
    {!!Form::password('password',['class'=>'form-control'])!!}
  </div>
   {!!Form::submit('save',['class'=>'btn btn-primary'])!!}
   {!!Form::close()!!}
 </div>    <!-- /.box-body -->
</div>





@endsection



