@extends('admin.index')
@section('content')
@push('js')
   <!-- Location picker -->
   <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
  <script type="text/javascript" src="{{url('design/admin')}}/dist/js/locationpicker.jquery.js"></script>
  <script type="text/javascript">
       $('#us1').locationpicker({
                        location: {
                            latitude: 46.15242437752303,
                            longitude: 2.7470703125
                        },
                        radius: 300,
                        markerIcon: '{{url('design/admin')}}/dist/img/map-marker-2-xl.png',
                        inputBinding: {
                                        latitudeInput: $('#lat'),
                                        longitudeInput: $('#lng'),
                                       // radiusInput: $('#us2-radius'),
                                        locationNameInput: $('#address')
                                     }
                                     });
  </script>
@endpush
<div class="box"> 
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['url'=>aurl('shapings'),'files'=>true])!!}
    <!--<input type="hidden" name="lat" value="{{old('lat')}}" id='lat'>
    <input type="hidden" name="lng" value="{{old('lng')}}" id='lng'> -->
  <div>
    {!!Form::label('name','Shaping Name')!!}
    {!!Form::text('name',old('name'),['class'=>'form-control'])!!}
  </div>


  <div>
    {!!Form::label('user_id','Owner Name')!!}
    {!!Form::select('user_id',App\User::where('level','company')->pluck('name','id'),old('user_id'),['class'=>'form-control'])!!}
  </div>


  

  <!--<div>
    {!!Form::label('address','Address')!!}
    {!!Form::text('address',old('address'),['class'=>'form-control address'])!!}
  </div>
  <div>
    <div id="us1" style="width: 500px; height: 400px;"></div>
  </div>-->

  <div class="form-group">
      {!! Form::label('logo','Logo') !!}
      {!! Form::file('logo',['class'=>'form-control']) !!}
  </div>

   {!!Form::submit('send',['class'=>'btn btn-primary'])!!}
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





