<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\CountriesDatatable;
use Illuminate\Http\Request;
use App\Model\Country;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountriesDatatable $country)
    {
        //
        return $country->render('admin.Countries.index',['title'=>'Countries Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Countries.create',['title'=>'Add New Country']);
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
            'country_name'=>'required',
            'mod'=>'required',
            'code'=>'required',
            'currency'=>'required',
            'logo'=>'required|'.v_image(),
             ],[],[
            'country_name'=>'Country Name',
            'mod'=>'Mod',
            'code'=>'Code',
            'currency'=>'Currency',
            'logo'=>'Logo',
            ]);
        if(request()->hasfile('logo'))
        {
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'countries',
                'upload_type'=>'single',

            ]);
        }
        Country::create($data);
        session()->flash('success','Country Added');
        return redirect(aurl('countries'));

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
        $country=Country::find($id);
        $title='Edit '.$country->country_name;
        return view('admin.Countries.edit',compact('title','country'));
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
            'country_name'=>'required',
            'mod'=>'required',
            'code'=>'required',
            'currency'=>'required',
            'logo'=>'sometimes|nullable|'.v_image(),
             ],[],[
            'country_name'=>'Country Name',
            'mod'=>'Mod',
            'code'=>'Code',
            'currency'=>'Currency',
            'logo'=>'Logo',
            ]);
        if(request()->hasfile('logo'))
        {
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'countries',
                'upload_type'=>'single',
                'delete_file'=>Country::find($id)->logo,

            ]);
        }
        Country::where('id',$id)->update($data);
        session()->flash('success','Country Updated');
        return redirect(aurl('countries'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country=Country::find($id);
        \Storage::delete($country->logo);
        $contry->delete();
        session()->flash('success','Country Delete');
        return redirect(aurl('admin'));
    }
    public function muilt_all()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id) {
                $country=Country::find($id);
                \Storage::delete($country->logo);
                $country->delete();
            }

             session()->flash('success','Countrys Delete');
        }
        else
        {
            $country=Country::find(request('item'));
            \Storage::delete($country->logo);
            $country->delete();
            session()->flash('success','Countries Delete');
        }
        session()->flash('success','Countries Delete');
        return redirect(aurl('countries'));
    }
}
