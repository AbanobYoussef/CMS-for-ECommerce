<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\StatesDatatable;
use Illuminate\Http\Request;
use App\Model\State;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StatesDatatable $state) 
    {
        //
        return $state->render('admin.states.index',['title'=>'States Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax())
        {
            if(request()->has('country_id'))
            {
                $select=request()->has('select')?request('select'):'';
                return \Form::select('city_id',\App\Model\City::where('country_id',request('country_id'))->pluck('city_name','id'),$select,['class'=>'form-control','placeholder'=>'......']);
            }
        }
        return view('admin.states.create',['title'=>'Add New State']);
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
            'state_name'=>'required',
            'country_id'=>'required',
            'city_id'=>'required',
             ],[],[
            'state_name'=>'state Name',
            'country_id'=>'country Name',
            'city_id'=>'city Name',
            ]);
        State::create($data);
        session()->flash('success','State Added');
        return redirect(aurl('states'));

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
        
        $state=State::find($id);
        $title='Edit '.$state->country_name;
        return view('admin.states.edit',compact('title','state'));
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
            'state_name'=>'required',
            'country_id'=>'required',
            'city_id'=>'required',
             ],[],[
            'state_name'=>'state Name',
            'country_id'=>'country Name',
            'city_id'=>'city Name',
            ]);
        State::where('id',$id)->update($data);
        session()->flash('success','State Updated');
        return redirect(aurl('states'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $State=State::find($id);
        $State->delete();
        session()->flash('success','State Delete');
        return redirect(aurl('states'));
    }
    public function muilt_all()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id) {
                $state=State::find($id);
                $state->delete();
            }

             session()->flash('success','State Delete');
        }
        else
        {
            $state=State::find(request('item'));
            $state->delete();
            session()->flash('success','States Delete');
        }
        return redirect(aurl('states'));
    }
}
