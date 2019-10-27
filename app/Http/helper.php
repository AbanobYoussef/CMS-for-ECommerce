<?php 
if (!function_exists('setting')) {
	function setting() {
		return \App\Model\Setting::orderBy('id', 'desc')->first();
	}
}

if (!function_exists('up')) {
  function up() {
    return new \App\Http\Controllers\Upload;
  }
}


if (!function_exists('check_mall')) {
  function check_mall($mid,$pid) {
    return \App\Model\MallProduct::where('product_id',$pid)->where('mall_id',$mid)->count()>0? true:false;
  }
}

if (!function_exists('load_dep')) {
  function load_dep($select=null,$dep_hide=null) {
    $departments=\App\Model\department::selectRaw('dep_name as text')->selectRaw('parent as parent')->selectRaw('id as id')->get(['text','parent','id']);
    $dep_arr=[];
    foreach($departments as $department)
    {
        $list_arr['icon']='';
        $list_arr['il_attr']='';
        $list_arr['a_attr']='';
        $list_arr['children']=[];
      if($select!=null && $select===$department->id)
      {
        
        $list_arr['state']=[
          'opened'=>true,
          'selected'=>true,
          'disabled'=>false,

        ];

      }

      if($dep_hide!=null && $dep_hide===$department->id )
      {
        
        $list_arr['state']=[
          'opened'=>false,
          'selected'=>false,
          'disabled'=>true,
          'hidden'=>true,

        ];
      }

      $list_arr['id']=$department->id;
      $list_arr['parent']=$department->parent!==null?$department->parent:'#';
      $list_arr['text']=$department->text;
      array_push($dep_arr, $list_arr);
    }

    return json_encode($dep_arr,JSON_UNESCAPED_UNICODE);
  }
}

if (!function_exists('get_parent')) 
{
    function get_parent($dep_id) 
    {
        $department=\App\Model\department::find($dep_id);
        if($department->parent!==null && $department->parent>0)
        {
           return get_parent($department->parent).",".$dep_id;
        }
        else
        {
           return $dep_id;
        }
    }
}



if (!function_exists('aurl'))
{
  function aurl($aurl=null)
  {
  	return url('admin/'.$aurl);
  }
}


if (!function_exists('admin'))
{
  function admin()
  {
  	return auth()->guard('webadmin');
  }
}



if (!function_exists('active_menu')) {
  function active_menu($link) {

    if ( request()->segment(2)==''and $link=='' ) 
    {
      return ['menu-open', 'display:block'];
    }  
    else if( request()->segment(2)=='admin' and $link=='admin')
    {
      return ['menu-open', 'display:block'];
    }
    else if( request()->segment(2)=='users' and $link=='users')
    {
      return ['menu-open', 'display:block'];
    }
    else if( request()->segment(2)=='settings' and $link=='settings')
    {
      return ['menu-open', 'display:block'];
    }
    else
    {
      return ['', ''];
    }
  }
}



if (!function_exists('v_image')) {
  function v_image($ext=null) {

    if($ext===null)
    {
      return 'image|mimes:jpg,jpeg,png,gif,bmp';
    }
    else
    {
      return 'image|mimes:'.$ext;
    }
    
  }
}