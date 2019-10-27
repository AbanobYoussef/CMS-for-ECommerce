<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\SizeDatatable;
use Illuminate\Http\Request;
use App\Model\size;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SizeDatatable $size)
    {
        //
        return $size->render('admin.size.index',['title'=>'size Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.size.create',['title'=>'Add New size']);
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
            'name'=>'required',
            'department_id'=>'required|numeric',
            'is_public'=>'required|in:yes,no',
             ],[],[
            'name'=>'Name',
            'department_id'=>'department name',
            'is_public'=>'state',
            ]);
        size::create($data);
        session()->flash('success','size Added');
        return redirect(aurl('size'));

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
        $size=size::find($id);
        $title='Edit '.$size->color_name;
        return view('admin.size.edit',compact('title','size'));
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
            'name'=>'required',
            'department_id'=>'required|numeric',
            'is_public'=>'required|in:yes,no',
             ],[],[
            'name'=>'Name',
            'department_id'=>'department name',
            'is_public'=>'state',
            ]);
        size::where('id',$id)->update($data);
        session()->flash('success','size Updated');
        return redirect(aurl('size'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size=size::find($id);
        $size->delete();
        session()->flash('success','size Delete');
        return redirect(aurl('size'));
    }
    public function muilt_all()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id) {
                $size=size::find($id);
                $size->delete();
            }

             session()->flash('success','size Delete');
        }
        else
        {
            $size=size::find(request('item'));
            $size->delete();
            session()->flash('success','size Delete');
        }
        return redirect(aurl('colors'));
    }
}
