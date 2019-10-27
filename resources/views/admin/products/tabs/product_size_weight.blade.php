@push('js')
<script type="text/javascript">
  $(document).ready(function() {
    var dataSelect=[
      @foreach(App\Model\Country::all() as $country)
      {
        "text":"{{ $country->country_name }}",
        "children":[
          @foreach($country->malls()->get() as $mall)
          {
            "id":{{ $mall->id }},
            "text":"{{ $mall->Mall_name }}",
            @if(check_mall($mall->id,$Product->id))
            "selected":true
            @endif
          },
          @endforeach
        ]
      },
      @endforeach
    ];

    $('.mall-select2').select2({
    	theme: "classic",
      data:dataSelect
    });
});
</script>
@endpush
<div id="Size_Weight" class="tab-pane fade">
  <h3>Size & Weight</h3>
  <div class="size_weight"></div>

  <div class="info_data hidden">
  	
  	<div class="form-group col-sm-4 col-xs-12">
      {!!Form::label('color_id','Color Name')!!}
      {!!Form::select('color_id',App\Model\Color::pluck('color_name','id'),$Product->color_id,['class'=>'form-control'])!!}
  </div>

  <div class="form-group col-sm-4 col-xs-12">
      {!!Form::label('trad_id','TradMark')!!}
      {!!Form::select('trad_id',App\Model\TradMarks::pluck('tradmark_name','id'),$Product->trad_id,['class'=>'form-control'])!!}
  </div>


  <div class="form-group col-sm-4 col-xs-12">
      {!!Form::label('mani_id','Manifactory Name')!!}
      {!!Form::select('mani_id',App\Model\Manifactories::pluck('Mani_name','id'),$Product->mani_id,['class'=>'form-control'])!!}
  </div>
  <div class="clearfix"></div>

  <div class="col-sm-12">
      {!!Form::label('malls','Malls')!!}
      <select name="mall[]" class="form-group mall-select2" multiple="multiple" style="width: 100%" >
      	
      </select>
  </div>

  </div>
</div>