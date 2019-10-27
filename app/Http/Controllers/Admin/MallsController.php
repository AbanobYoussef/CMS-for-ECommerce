<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\MallsDatatable;
use Illuminate\Http\Request;
use App\Model\Mall;

class MallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MallsDatatable $mall)
    {
        //
        return $mall->render('admin.malls.index',['title'=>'Mall Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.malls.create',['title'=>'Add New Mall']);
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
            'Mall_name'=>'required',
            'email'=>'required|email',
            'country_id'=>'required',
            'mobile'=>'required|numeric',
            'facebook'=>'sometimes|nullable|url',
            'twitter'=>'sometimes|nullable|url',
            'website'=>'sometimes|nullable|url',
            'contact_name'=>'sometimes|nullable|string',
            'lat'=>'sometimes|nullable',
            'lag'=>'sometimes|nullable',
            'logo'=>'sometimes|nullable|'.v_image(),
             ],[],[
            'Mall_name'=>'Name',
            'email'=>'Email',
            'mobile'=>'Mobile',
            'facebook'=>'Facebook',
            'twitter'=>'Twitter',
            'website'=>'Website',
            'contact_name'=>'Contact Name',
            'lat'=>'Lat',
            'lag'=>'Lag',
            'logo'=>'Logo',
            ]);
        if(request()->hasfile('logo'))
        {
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'Manifactories',
                'upload_type'=>'single',

            ]);
        }
        Mall::create($data);
        session()->flash('success','Manifactory Added');
        return redirect(aurl('malls'));

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
        $mall=Mall::find($id);
        $title='Edit '.$mall->Mall_name;
        return view('admin.malls.edit',compact('title','mall'));
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
            'Mall_name'=>'required',
            'country_id'=>'required',
            'email'=>'required|email',
            'mobile'=>'required|numeric',
            'facebook'=>'sometimes|nullable|url',
            'twitter'=>'sometimes|nullable|url',
            'website'=>'sometimes|nullable|url',
            'contact_name'=>'sometimes|nullable|string',
            'lat'=>'sometimes|nullable',
            'lag'=>'sometimes|nullable',
            'logo'=>'sometimes|nullable|'.v_image(),
             ],[],[
            'Mall_name'=>'Name',
            'email'=>'Email',
            'mobile'=>'Mobile',
            'facebook'=>'Facebook',
            'twitter'=>'Twitter',
            'website'=>'Website',
            'contact_name'=>'Contact Name',
            'lat'=>'Lat',
            'lag'=>'Lag',
            'logo'=>'Logo',
            ]);
        if(request()->hasfile('logo'))
        {
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'malls',
                'upload_type'=>'single',
                'delete_file'=>Mall::find($id)->logo,

            ]);
        }
        Mall::where('id',$id)->update($data);
        session()->flash('success','Mall Updated');
        return redirect(aurl('malls'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mall=Mall::find($id);
        \Storage::delete($mall->logo);
        $mall->delete();
        session()->flash('success','Mall Delete');
        return redirect(aurl('malls'));
    }
    public function muilt_all()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id) {
                $mall=Mall::find($id);
                \Storage::delete($mall->logo);
                $mall->delete();
            }

             session()->flash('success','Mall Delete');
        }
        else
        {
            $mall=Mall::find(request('item'));
            \Storage::delete($mall->logo);
            $mall->delete();
            session()->flash('success','Malls Delete');
        }
        return redirect(aurl('malls'));
    }
}
