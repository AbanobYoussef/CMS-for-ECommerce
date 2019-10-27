@extends('admin.index')
@section('content')

<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['route'=>['cities.update',$city->id],'method'=>'put'])!!}
  <div>
    {!!Form::label('city_name','city Name')!!}
    {!!Form::text('city_name',$city->city_name,['class'=>'form-control'])!!}
  </div>
  <div>
      {!!Form::label('country_id','Country Name')!!}
      {!!Form::select('country_id',App\Model\Country::pluck('country_name','id'),old('country_id'),['class'=>'form-control'])!!}
  </div>
   {!!Form::submit('save',['class'=>'btn btn-primary'])!!}
   {!!Form::close()!!}
 </div>    <!-- /.box-body -->
</div>





@endsection




