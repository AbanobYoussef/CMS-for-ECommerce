@extends('admin.index')
@section('content')


@push('js')
<script>
  
  $(document).ready(function(){

    @if(old('country_id'))

    $.ajax({
          url:'{{aurl("states/create")}}',
          type:'get',
          dataType:'html',
          data:{country_id:old('country_id'),selete:old('city_id')},
          success:function(data){
            $('.city').html(data);
          }
        });

    @endif

    $(document).on('change','.country_id',function(){

      var country = $('.country_id option:selected').val();

      if(country>0)
      {
        $.ajax({
          url:'{{aurl("states/create")}}',
          type:'get',
          dataType:'html',
          data:{country_id:country,selete:''},
          success:function(data){
            $('.city').html(data);
          }
        });
      }



    });
  });
</script>



@endpush

<div class="box">
 <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
 </div>
            <!-- /.box-header -->
 
 <div class="box-body">
 	{!!Form::open(['url'=>aurl('states')])!!}
  <div>
    {!!Form::label('state_name','State Name')!!}
    {!!Form::text('state_name',old('state_name'),['class'=>'form-control'])!!}
  </div>

  <div style="margin-bottom: 1%">
      {!!Form::label('country_id','Country Name')!!}
      {!!Form::select('country_id',App\Model\Country::pluck('country_name','id'),old('country_id'),['class'=>' country_id form-control','placeholder'=>'...............'])!!}
  </div>

  <div style="margin-bottom: 1%">
      {!!Form::label('city_id','City Name')!!}
      <span  class="city"></span>
  </div>

   {!!Form::submit('send',['class'=>'btn btn-primary'])!!}
   {!!Form::close()!!}
 </div>    <!-- /.box-body -->


</div>





@endsection



