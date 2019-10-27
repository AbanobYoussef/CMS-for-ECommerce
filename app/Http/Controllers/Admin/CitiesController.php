<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\CitiesDatatable;
use Illuminate\Http\Request;
use App\Model\City;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CitiesDatatable $country) 
    {
        //
        return $country->render('admin.cities.index',['title'=>'Cities Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create',['title'=>'Add New city']);
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
            'city_name'=>'required',
            'country_id'=>'required',
             ],[],[
            'city_name'=>'City Name',
            'country_id'=>'City Name',
            ]);
        City::create($data);
        session()->flash('success','City Added');
        return redirect(aurl('cities'));

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
        $city=City::find($id);
        $title='Edit '.$city->country_name;
        return view('admin.cities.edit',compact('title','city'));
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
            'city_name'=>'required',
            'country_id'=>'required',
             ],[],[
            'city_name'=>'City Name',
            'country_id'=>'City Name',
            ]);
        City::where('id',$id)->update($data);
        session()->flash('success','city Updated');
        return redirect(aurl('cities'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city=City::find($id);
        $city->delete();
        session()->flash('success','city Delete');
        return redirect(aurl('cities'));
    }
    public function muilt_all()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id) {
                $city=City::find($id);
                $city->delete();
            }

             session()->flash('success','city Delete');
        }
        else
        {
            $city=City::find(request('item'));
            $city->delete();
            session()->flash('success','cities Delete');
        }
        session()->flash('success','cities Delete');
        return redirect(aurl('cities'));
    }
}
