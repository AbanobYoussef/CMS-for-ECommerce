@extends('admin.index')
@section('content')

<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['route'=>['tradMarks.update',$tradMark->id],'method'=>'put'])!!}
  <div>
    {!!Form::label('tradmark_name','Trad Mark Name')!!}
    {!!Form::text('tradmark_name',$tradMark->tradmark_name,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
      {!! Form::label('logo','Flag') !!}
      {!! Form::file('logo',['class'=>'form-control']) !!}
      @if(!empty($tradMark->logo))
        <img src="{{Storage::url($tradMark->logo)}}" style="height: 50px; width: 50px">
      @endif
  </div>
   {!!Form::submit('save',['class'=>'btn btn-primary'])!!}
   {!!Form::close()!!}
 </div>    <!-- /.box-body -->
</div>





@endsection




