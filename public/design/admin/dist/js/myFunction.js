function check_all()
      {
        $('input[class="item_checkbox"]:checkbox').each(function(){
            if($('input[class="check_all"]:checkbox:checked').length===0)
            {
                $(this).prop('checked',false);
            }
            else
            {
              $(this).prop('checked',true);
            }
        });
      }


function delete_all()
      {
        $(document).on('click','.del_all',function(){
           $('#form-data').submit();
        });
        $(document).on('click','.delBtn',function(){
           var checked=$('input[class="item_checkbox"]:checkbox:checked').length;
           if(checked>0)
           {
            $('.not_empty_record').removeClass('hidden');
            $('.empty_record').addClass('hidden');
            $('.record_count').text(checked);
           }
           else
           {
            $('.not_empty_record').addClass('hidden');
            $('.empty_record').removeClass('hidden');
            $('.record_count').text('');
           }
            $('#multiDelete').modal('show');
        });
      }
