<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\StatesDatatable;
use Illuminate\Http\Request;
use App\Model\department;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        return view('admin.departments.index',['title'=>'Departments Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.departments.create',['title'=>'Add New State']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data =$this->validate(request(),[
            'dep_name'=>'required',
            'parent'=>'sometimes|nullable|numeric',
            'icon'=>'sometimes|nullable|'.v_image(),
            'keywords'=>'sometimes|nullable|string',
            'description'=>'sometimes|nullable|string',
             ],[],[
            'dep_name'=>'Department Name',
            'parent'=>'Department Parent',
            'icon'=>'Department Icon',
            'keywords'=>'Keywords',
            'description'=>'Description',
            ]);
        if(request()->hasfile('icon'))
        {
            $data['icon']=up()->upload([
                'file'=>'icon',
                'path'=>'departments',
                'upload_type'=>'single',

            ]);
        }
        department::create($data);
        session()->flash('success','department Added');
        return redirect(aurl('departments'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $department=department::find($id);
        $title='Edit '.$department->dep_name;
        return view('admin.departments.edit',compact('title','department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data =$this->validate(request(),[
            'dep_name'=>'required',
            'parent'=>'sometimes|nullable|numeric',
            'icon'=>'sometimes|nullable|'.v_image(),
            'keywords'=>'sometimes|nullable|string',
            'description'=>'sometimes|nullable|string',
             ],[],[
            'dep_name'=>'Department Name',
            'parent'=>'Department Parent',
            'icon'=>'Department Icon',
            'keywords'=>'Keywords',
            'description'=>'Description',
            ]);
        if(request()->hasfile('icon'))
        {
            $data['icon']=up()->upload([
                'file'=>'icon',
                'path'=>'departments',
                'upload_type'=>'single',
                'delete_file'=>department::find($id)->icon,

            ]);
        }
        department::find($id)->update($data);
        session()->flash('success','State Updated');
        return redirect(aurl('departments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public static function delete_parent($id)
    {
        $dep_parent=department::where('parent',$id)->get();
        foreach ($dep_parent as $sub) {
            self::delete_parent($sub->id);
            if(!empty($sub->icon))
            {
                \Storage::has($sub->icon)?\Storage::delete($sub->icon):'';
            }
            $department=department::find($sub->id);
            if(!empty($department))
            {
                $department->delete();
            }
        }

        $dep=department::find($id);
        if(!empty($dep->icon))
            {
                \Storage::has($dep->icon)?\Storage::delete($dep->icon):'';
            }
         $dep->delete();   
            
    }

    public function destroy($id)
    {
        self::delete_parent($id);
        session()->flash('success','State Delete');
        return redirect(aurl('departments'));
    }
   
}
