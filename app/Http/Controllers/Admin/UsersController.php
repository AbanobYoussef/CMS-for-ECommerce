<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\UsersDatatable;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDatatable $user)
    {
        //
        return $user->render('admin.users.index',['title'=>'User Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create',['title'=>'Add New User']);
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
            'level'=>'required|in:user,company,vendor',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
             ],[],[
            'name'=>'Name',
            'email'=>'Email',
            'level'=>'Level',
            'password'=>'Password'
            ]);
        $data['password']=bcrypt(request('password'));
        User::create($data);
        session()->flash('success','User Added');
        return redirect(aurl('users'));

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
        $user=User::find($id);
        $title='Edit '.$user->name;
        return view('admin.users.edit',compact('title','user'));
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
            'level'=>'required|in:user,company,vendor',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'sometimes|nullable|min:6'
             ],[],[
            'name'=>'Name',
            'email'=>'Email',         
            'level'=>'Level',
            'password'=>'Password'
            ]);
        if(request()->has('password'))
        {
            $data['password']=bcrypt(request('password'));
        }
        User::where('id',$id)->update($data);
        session()->flash('success','User Updated');
        return redirect(aurl('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        session()->flash('success','User Delete');
        return redirect(aurl('users'));
    }
    public function muilt_all()
    {
        if(is_array(request('item')))
        {
            User::destroy(request('item'));
        }
        else
        {
            User::find(request('item'))->delete();
        }
        session()->flash('success','Users Delete');
        return redirect(aurl('users'));
    }
}
