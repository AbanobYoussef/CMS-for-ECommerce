<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\TrandMarksDatatable;
use Illuminate\Http\Request;
use App\Model\TradMarks;

class TrandMarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TrandMarksDatatable $tradMark)
    {
        //
        return $tradMark->render('admin.tradMarks.index',['title'=>'Trad Marks Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tradMarks.create',['title'=>'Add New Trad Mark']);
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
            'tradmark_name'=>'required',
            'logo'=>'required|'.v_image(),
             ],[],[
            'tradmark_name'=>'Trad Mark Name',
            'logo'=>'Logo',
            ]);
        if(request()->hasfile('logo'))
        {
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'tradMarks',
                'upload_type'=>'single',

            ]);
        }
        TradMarks::create($data);
        session()->flash('success','Trad Mark Added');
        return redirect(aurl('tradMarks'));

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
        $tradMark=TradMarks::find($id);
        $title='Edit '.$tradMark->tradmark_name;
        return view('admin.tradMarks.edit',compact('title','tradMark'));
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
            'tradmark_name'=>'required',
            'logo'=>'sometimes|nullable|'.v_image(),
             ],[],[
            'tradmark_name'=>'Trad Mark Name',
            'logo'=>'Logo',
            ]);
        if(request()->hasfile('logo'))
        {
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'tradMarks',
                'upload_type'=>'single',
                'delete_file'=>TradMarks::find($id)->logo,

            ]);
        }
        TradMarks::where('id',$id)->update($data);
        session()->flash('success','Trad Mark Updated');
        return redirect(aurl('tradMarks'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tradMark=TradMarks::find($id);
        \Storage::delete($tradMark->logo);
        $tradMark->delete();
        session()->flash('success','Trad Mark Delete');
        return redirect(aurl('tradMarks'));
    }
    public function muilt_all()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id) {
                $tradMark=TradMarks::find($id);
                \Storage::delete($tradMark->logo);
                $tradMark->delete();
            }

             session()->flash('success','Trad Mark Delete');
        }
        else
        {
            $tradMark=TradMarks::find(request('item'));
            \Storage::delete($tradMark->logo);
            $tradMark->delete();
            session()->flash('success','tradMarks Delete');
        }
        session()->flash('success','tradMarks Delete');
        return redirect(aurl('tradMarks'));
    }
}
