<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ShapingsDatatable;
use Illuminate\Http\Request;
use App\Model\Shapings;

class ShapingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShapingsDatatable $shaping)
    {
        //
        return $shaping->render('admin.shapings.index',['title'=>'Shaping Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shapings.create',['title'=>'Add New Shaping']);
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
            'user_id'=>'required|numeric',
            'lat'=>'sometimes|nullable',
            'lag'=>'sometimes|nullable',
            'logo'=>'sometimes|nullable|'.v_image(),
             ],[],[
            'name'=>'Name',
            'user_id'=>'Owner Name',
            'lat'=>'Lat',
            'lag'=>'Lag',
            'logo'=>'Logo',
            ]);
        if(request()->hasfile('logo'))
        {
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'shapings',
                'upload_type'=>'single',

            ]);
        }
        Shapings::create($data);
        session()->flash('success','Shaping Added');
        return redirect(aurl('shapings'));

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
        $Shaping=Shapings::find($id);
        $title='Edit '.$Shaping->name;
        return view('admin.shapings.edit',compact('title','Shaping'));
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
            'user_id'=>'required|numeric',
            'lat'=>'sometimes|nullable',
            'lag'=>'sometimes|nullable',
            'logo'=>'sometimes|nullable|'.v_image(),
             ],[],[
            'Mani_name'=>'Name',
            'user_id'=>'Owner Name',
            'lat'=>'Lat',
            'lag'=>'Lag',
            'logo'=>'Logo',
            ]);
        if(request()->hasfile('logo'))
        {
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'shapings',
                'upload_type'=>'single',
                'delete_file'=>Shapings::find($id)->logo,

            ]);
        }
        Shapings::where('id',$id)->update($data);
        session()->flash('success','Shaping Updated');
        return redirect(aurl('shapings'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shaping=Shapings::find($id);
        \Storage::delete($shaping->logo);
        $shaping->delete();
        session()->flash('success','Shaping Delete');
        return redirect(aurl('shapings'));
    }
    public function muilt_all()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id) {
                $shaping=Shapings::find($id);
                \Storage::delete($shaping->logo);
                $shaping->delete();
            }

             session()->flash('success','Shaping Delete');
        }
        else
        {
            $shaping=Shapings::find(request('item'));
            \Storage::delete($shaping->logo);
            $shaping->delete();
            session()->flash('success','Shapings Delete');
        }
        return redirect(aurl('shapings'));
    }
}
