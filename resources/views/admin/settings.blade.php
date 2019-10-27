@extends('admin.index')
@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::open(['url'=>aurl('settings'),'files'=>true]) !!}
    </div>
    <div class="form-group">
      {!! Form::label('email','email') !!}
      {!! Form::email('email',setting()->email,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('logo',trans('admin.logo')) !!}
      {!! Form::file('logo',['class'=>'form-control']) !!}
      @if(!empty(setting()->logo))
        <img src="{{Storage::url(setting()->logo)}}" style="height: 50px; width: 50px">
      @endif
    </div>
    <div class="form-group">
      {!! Form::label('icon','icon') !!}
      {!! Form::file('icon',['class'=>'form-control']) !!}
      @if(!empty(setting()->icon))
        <img src="{{Storage::url(setting()->icon)}}" style="height: 50px; width: 50px">
      @endif
    </div>
    <div class="form-group">
      {!! Form::label('description','description') !!}
      {!! Form::textarea('description',setting()->description,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('keywords','keywords') !!}
      {!! Form::textarea('keywords',setting()->keywords,['class'=>'form-control']) !!}
    </div>
     <div class="form-group">
      {!! Form::label('status','status') !!}
      {!! Form::select('status',['open'=>'open','close'=>'close'],setting()->status,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('message_maintenance','message_maintenance') !!}
      {!! Form::textarea('message_maintenance',setting()->message_maintenance,['class'=>'form-control']) !!}
    </div>
    {!! Form::submit('save',['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection