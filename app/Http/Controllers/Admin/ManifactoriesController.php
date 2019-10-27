<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ManifactoriesDatatable;
use Illuminate\Http\Request;
use App\Model\Manifactories;

class ManifactoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManifactoriesDatatable $manifactory)
    {
        //
        return $manifactory->render('admin.manifactories.index',['title'=>'Manifactory Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manifactories.create',['title'=>'Add New Manifactory']);
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
            'Mani_name'=>'required',
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
            'Mani_name'=>'Name',
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
        Manifactories::create($data);
        session()->flash('success','Manifactory Added');
        return redirect(aurl('manifactories'));

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
        $Manifactory=Manifactories::find($id);
        $title='Edit '.$Manifactory->Mani_name;
        return view('admin.manifactories.edit',compact('title','Manifactory'));
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
            'Mani_name'=>'required',
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
            'Mani_name'=>'Name',
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
                'path'=>'manifactories',
                'upload_type'=>'single',
                'delete_file'=>Manifactories::find($id)->logo,

            ]);
        }
        Manifactories::where('id',$id)->update($data);
        session()->flash('success','Manifactory Updated');
        return redirect(aurl('manifactories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manifactory=Manifactories::find($id);
        \Storage::delete($manifactory->logo);
        $manifactory->delete();
        session()->flash('success','Manifactory Delete');
        return redirect(aurl('manifactories'));
    }
    public function muilt_all()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id) {
                $manifactory=Manifactories::find($id);
                \Storage::delete($manifactory->logo);
                $manifactory->delete();
            }

             session()->flash('success','Manifactory Delete');
        }
        else
        {
            $manifactory=Manifactories::find(request('item'));
            \Storage::delete($manifactory->logo);
            $manifactory->delete();
            session()->flash('success','Manifactories Delete');
        }
        return redirect(aurl('manifactories'));
    }
}
