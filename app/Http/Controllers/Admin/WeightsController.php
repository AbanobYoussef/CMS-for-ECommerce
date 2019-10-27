<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\WeightsDatatable;
use Illuminate\Http\Request;
use App\Model\Weight;

class WeightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WeightsDatatable $weight)
    {
        //
        return $weight->render('admin.weights.index',['title'=>'Weight Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weights.create',['title'=>'Add New Weight']);
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
             ],[],[
            'name'=>'Name',
            ]);
        Weight::create($data);
        session()->flash('success','Weight Added');
        return redirect(aurl('weights'));

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
        $Weight=Weight::find($id);
        $title='Edit '.$Weight->name;
        return view('admin.weights.edit',compact('title','Weight'));
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
             ],[],[
            'name'=>'Name',
            ]);
        Weight::where('id',$id)->update($data);
        session()->flash('success','Weight Updated');
        return redirect(aurl('weights'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Weight=Weight::find($id);
        $Weight->delete();
        session()->flash('success','Weight Delete');
        return redirect(aurl('weights'));
    }
    public function muilt_all()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id) {
                $Weight=Weight::find($id);
                $Weight->delete();
            }

             session()->flash('success','Weight Delete');
        }
        else
        {
            $Weight=Weight::find(request('item'));
            $Weight->delete();
            session()->flash('success','Weights Delete');
        }
        return redirect(aurl('weights'));
    }
}
