<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDatatable;
use Illuminate\Http\Request;
use App\Admins;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDatatable $admin)
    {
        //
        return $admin->render('admin.admins.index',['title'=>'Admin Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create',['title'=>'Add New Admin']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =$this->validate(request(),[
            'name'=>'required',
            'email'=>'required|email|unique:admin',
            'password'=>'required|min:6'
             ],[],[
            'name'=>'Name',
            'email'=>'Email',
            'password'=>'Password'
            ]);
        $data['password']=bcrypt(request('password'));
        Admins::create($data);
        session()->flash('success','Admin Added');
        return redirect(aurl('admin'));

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
        $admin=Admins::find($id);
        $title='Edit '.$admin->name;
        return view('admin.admins.edit',compact('title','admin'));
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
            'email'=>'required|email|unique:admin,email,'.$id,
            'password'=>'sometimes|nullable|min:6'
             ],[],[
            'name'=>'Name',
            'email'=>'Email',
            'password'=>'Password'
            ]);
        if(request()->has('password'))
        {
            $data['password']=bcrypt(request('password'));
        }
        Admins::where('id',$id)->update($data);
        session()->flash('success','Admin Updated');
        return redirect(aurl('admin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admins::find($id)->delete();
        session()->flash('success','Admin Delete');
        return redirect(aurl('admin'));
    }
    public function muilt_all()
    {
        if(is_array(request('item')))
        {
            Admins::destroy(request('item'));
        }
        else
        {
            Admins::find(request('item'))->delete();
        }
        session()->flash('success','Admins Delete');
        return redirect(aurl('admin'));
    }
}
