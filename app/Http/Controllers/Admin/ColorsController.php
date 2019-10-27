<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ColorsDatatable;
use Illuminate\Http\Request;
use App\Model\Color;

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ColorsDatatable $color)
    {
        //
        return $color->render('admin.colors.index',['title'=>'Color Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.create',['title'=>'Add New Color']);
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
            'color_name'=>'required',
            'color'=>'required|string',
             ],[],[
            'color_name'=>'Name',
            'color'=>'Color',
            ]);
        Color::create($data);
        session()->flash('success','Color Added');
        return redirect(aurl('colors'));

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
        $Color=Color::find($id);
        $title='Edit '.$Color->color_name;
        return view('admin.colors.edit',compact('title','Color'));
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
            'color_name'=>'required',
            'color'=>'required|string',
             ],[],[
            'color_name'=>'Name',
            'color'=>'Color',
            ]);
        Color::where('id',$id)->update($data);
        session()->flash('success','Color Updated');
        return redirect(aurl('colors'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Color=Color::find($id);
        $Color->delete();
        session()->flash('success','Color Delete');
        return redirect(aurl('colors'));
    }
    public function muilt_all()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id) {
                $Color=Color::find($id);
                $Color->delete();
            }

             session()->flash('success','Color Delete');
        }
        else
        {
            $Color=Color::find(request('item'));
            $Color->delete();
            session()->flash('success','Color Delete');
        }
        return redirect(aurl('colors'));
    }
}
