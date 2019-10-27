@extends('admin.index')
@section('content')

<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['url'=>aurl('tradMarks'),'files'=>true])!!}
  <div>
    {!!Form::label('tradmark_name','Country Name')!!}
    {!!Form::text('tradmark_name',old('tradmark_name'),['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
      {!! Form::label('logo','Logo') !!}
      {!! Form::file('logo',['class'=>'form-control']) !!}
  </div>

   {!!Form::submit('send',['class'=>'btn btn-primary'])!!}
   {!!Form::close()!!}
 </div>    <!-- /.box-body -->


</div>





@endsection



