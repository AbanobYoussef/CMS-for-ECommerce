@extends('admin.index')
@section('content')

<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['route'=>['users.update',$user->id],'method'=>'put'])!!}
  <div>
    {!!Form::label('name','User Name')!!}
    {!!Form::text('name',$user->name,['class'=>'form-control'])!!}
  </div>
  <div>
    {!!Form::label('email','User email')!!}
    {!!Form::email('email',$user->email,['class'=>'form-control'])!!}
  </div>
  <div style="margin-bottom: .5%">
    {!!Form::label('password','User password')!!}
    {!!Form::password('password',['class'=>'form-control'])!!}
  </div>
  <div style="margin: .5%">
    {!!Form::label('level','User level')!!}
    {!!Form::select('level',['user'=>'user','vendor'=>'vendor','company'=>'company'],$user->level,['class'=>'form-control','placeholder'=>'........'])!!}
  </div>
   {!!Form::submit('save',['class'=>'btn btn-primary'])!!}
   {!!Form::close()!!}
 </div>    <!-- /.box-body -->
</div>





@endsection



