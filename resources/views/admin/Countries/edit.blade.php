@extends('admin.index')
@section('content')

<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['route'=>['countries.update',$country->id],'method'=>'put'])!!}
  <div>
    {!!Form::label('country_name','Country Name')!!}
    {!!Form::text('country_name',$country->country_name,['class'=>'form-control'])!!}
  </div>

  <div>
    {!!Form::label('mod','Mod')!!}
    {!!Form::text('mod',$country->mod,['class'=>'form-control'])!!}
  </div>

  <div>
    {!!Form::label('code','Code')!!}
    {!!Form::text('code',$country->code,['class'=>'form-control'])!!}
  </div>

   <div>
    {!!Form::label('currency','Currency')!!}
    {!!Form::text('currency',old('currency'),['class'=>'form-control'])!!}
  </div>
  
  <div class="form-group">
      {!! Form::label('logo','Flag') !!}
      {!! Form::file('logo',['class'=>'form-control']) !!}
      @if(!empty($country->logo))
        <img src="{{Storage::url($country->logo)}}" style="height: 50px; width: 50px">
      @endif
  </div>
   {!!Form::submit('save',['class'=>'btn btn-primary'])!!}
   {!!Form::close()!!}
 </div>    <!-- /.box-body -->
</div>





@endsection




