@extends('admin.index')
@section('content')

@push('js')


<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('click','.Save_Continue',function(){
      var form_data = $('#product_form').serialize();
      $.ajax({
        url:'{{ aurl("products/".$Product->id) }}',
        dataType:'json',
        type:'post',
        data:form_data ,
        beforeSend: function(){
          $('.load_save_c').removeClass('hidden');
          $('.validate_message').html('');
          $('.error_message').addClass('hidden');
          $('.success_message').html('').addClass('hidden');
        },
        success: function(data){
          if(data.status==true)
          {
            $('.load_save_c').addClass('hidden');
            $('.success_message').html('<h1>'+data.message+'</h1>').removeClass('hidden');
          }
        },
        error(response){
          $('.load_save_c').addClass('hidden');
          var error_li='';
          $.each(response.responseJSON.errors,function(index,value){
              error_li+='<li>'+value+'</li>';
          });

          $('.validate_message').html(error_li);
          $('.error_message').removeClass('hidden');
        },

      });
      return false;
    });



    $(document).on('click','.Save',function(){
      $('#product_form').submit();
      return false;
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
 	{!!Form::open(['url'=>aurl("products/".$Product->id),'files'=>true,'method'=>'put','id'=>'product_form'])!!}
  <a href="#" class="btn btn-primary Save">Save <i class="fa fa-floppy-o"></i></a>
  <a href="#" class="btn btn-success Save_Continue">Save & Continue <i class="fa fa-floppy-o"></i></a>
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del{{$Product->id}}"><i class="fa fa-trash"></i>Delete </button>

  <div class="alert alert-danger error_message hidden">
    <ul class="validate_message">
      
    </ul>
  </div>
  <div class="alert alert-success success_message hidden"></div>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#Product_Info">Product Info <i class="fa fa-info"></i></a></li>
    <li><a data-toggle="tab" href="#department">Department <i class="fa fa-list"></i></a></li>
    <li><a data-toggle="tab" href="#Product_Settings">Product Settings <i class="fa fa-cog"></i></a></li>
    <li><a data-toggle="tab" href="#Product_Media">Product Media <i class="fa fa-photo"></i></a></li>
    <li><a data-toggle="tab" href="#Size_Weight">Size & Weight <i class="fa fa-info-circle"></i></a></li>
    <li><a data-toggle="tab" href="#More_Info">More Info <i class="fa fa-database"></i></a></li>
  </ul>

  <div class="tab-content" style="margin-left: .5%">

   @include('admin.products.tabs.product_info')

   @include('admin.products.tabs.department')


   @include('admin.products.tabs.product_setting')


   @include('admin.products.tabs.product_media')


   @include('admin.products.tabs.product_size_weight')


   @include('admin.products.tabs.other_data')

  </div>










  <a href="#" class="btn btn-primary Save">Save <i class="fa fa-floppy-o"></i></a>
  <a href="#" class="btn btn-success Save_Continue">Save & Continue <i class="fa fa-floppy-o"></i></a>
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del{{$Product->id}}"><i class="fa fa-trash"></i>Delete </button>
   {!!Form::close()!!}
 </div>    <!-- /.box-body -->


</div>

<style>
  div
  {
    margin-bottom: 1%
  }
</style>




<!-- Modal -->
<div id="del{{$Product->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete {{$title}}</h4>
      </div>
    {!! Form::open(['route'=>['products.destroy',$Product->id],'method'=>'delete'])!!}
      <div class="modal-body">
        <p>Do You Agree To Delete {{$title}}</p>
      </div>
      <div class="modal-footer">
        {!!Form::submit('Delete',['class'=>"btn btn-danger",'style'=>'width:16%'])!!}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      {!!Form::close()!!}
    </div>

  </div>
</div>
@endsection









