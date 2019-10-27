@extends('admin.index')
@section('content')

<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['url'=>aurl('countries'),'files'=>true])!!}
  <div>
    {!!Form::label('country_name','Country Name')!!}
    {!!Form::text('country_name',old('country_name'),['class'=>'form-control'])!!}
  </div>

  <div>
    {!!Form::label('mod','Mod')!!}
    {!!Form::text('mod',old('mod'),['class'=>'form-control'])!!}
  </div>

  <div>
    {!!Form::label('code','Code')!!}
    {!!Form::text('code',old('code'),['class'=>'form-control'])!!}
  </div>


  <div>
    {!!Form::label('currency','Currency')!!}
    {!!Form::text('currency',old('currency'),['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
      {!! Form::label('logo','Flag') !!}
      {!! Form::file('logo',['class'=>'form-control']) !!}
  </div>

   {!!Form::submit('send',['class'=>'btn btn-primary'])!!}
   {!!Form::close()!!}
 </div>    <!-- /.box-body -->


</div>





@endsection



