
<div id="department" class="tab-pane fade">
  <h3>Department</h3>

<input type="hidden" name="department_id" class="department_id" value="{{old('$Product->department_id')}}">
<div id="jstree"></div>
</div>


<script type="text/javascript">
  $(document).ready(function(){

            $('#jstree').jstree({
          "core" : {
            'data' : {!!  load_dep(old('$Product->department_id'))!!},
            "themes" : {
              "variant" : "large"
            }
          },
          "checkbox" : {
            "keep_selected_style" : true
          },
          "plugins" : [ "wholerow"]
        });



        $('#jstree').on('changed.jstree',function(e,data){

            var i , j , r=[];

            for (i = 0, j=data.selected.length; i<j; i++) {
              r.push(data.instance.get_node(data.selected[i]).id);
            }
            var department=r.join(', ');
            $('.department_id').val(department);

            $.ajax({
              url:"{{ aurl('load/weight/size') }}",
              dataType:'html',
              type:'post',
              data:{_token:'{{csrf_token()}}',dep_id:department , product_id:'{{ $Product->id }}'},
              success:function(data){
                $('.size_weight').html(data);
                $('.info_data').removeClass('hidden');
              }
            });

        });


  });
</script>