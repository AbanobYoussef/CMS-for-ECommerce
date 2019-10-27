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
 	{!!Form::open(['route'=>['malls.update',$mall->id],'method'=>'put'])!!}
     <!--<input type="hidden" name="lat" value="$mall->lat" id='lat'>
    <input type="hidden" name="lng" value="$mall->lng" id='lng'> -->
   <div>
    {!!Form::label('Mall_name','Mall Name')!!}
    {!!Form::text('Mall_name',$mall->Mall_name,['class'=>'form-control'])!!}
  </div>


  <div>
    {!!Form::label('email','Email')!!}
    {!!Form::email('email',$mall->email,['class'=>'form-control'])!!}
  </div>


  <div>
    {!!Form::label('mobile','Mobile')!!}
    {!!Form::text('mobile',$mall->mobile,['class'=>'form-control'])!!}
  </div>

  <!--<div>
    {!!Form::label('address','Address')!!}
    {!!Form::text('address',old('address'),['class'=>'form-control address'])!!}
  </div>
  <div>
    <div id="us1" style="width: 500px; height: 400px;"></div>
  </div>-->
  
  <div>
    {!!Form::label('facebook','Facebook Link')!!}
    {!!Form::url('facebook',$mall->facebook,['class'=>'form-control'])!!}
  </div>


  <div>
    {!!Form::label('twitter','Twitter Link')!!}
    {!!Form::url('twitter',$mall->twitter,['class'=>'form-control'])!!}
  </div>


  <div>
    {!!Form::label('website','Website Link')!!}
    {!!Form::url('website',$mall->website,['class'=>'form-control'])!!}
  </div>



  <div>
    {!!Form::label('contact_name','Contact Name')!!}
    {!!Form::text('contact_name',$mall->contact_name,['class'=>'form-control'])!!}
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



<style>
  div
  {
    margin-bottom: 1%
  }
</style>

@endsection




