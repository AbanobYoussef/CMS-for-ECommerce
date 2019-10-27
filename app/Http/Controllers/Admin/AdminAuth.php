<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admins;
use App\Mail\AdminResetPassword;
use DB;
use Carbon\Carbon;
use Mail;
class AdminAuth extends Controller
{
    //
    public function login()
    {
    	if(!auth()->guard('webadmin')->user())
    	return view('admin.login');
    	else
    		return redirect('admin');
    }

    public function dOlogin()
    { 
    	$remember= request('RememberMe')==1?true:false;
    	if(admin()->attempt(['email'=>request('email'),'password'=>request('password')],$remember))
    	{
    		return redirect('admin');
    	} else {
    		session()->flash('error',trans('admin.inccorrect_info_login'));
    	}
    }
    public function logout()
    {
    	auth()->guard('webadmin')->logout();
    	return redirect('admin/login');
    }

    public function forget_password()
    {
    	return view('admin.forget_password');
    }

     public function forget_password_post()
    {
    	$admin=Admins::where('email',request('email'))->first();
    	 if(!empty($admin))
    	 {
    	 	$token=app('auth.password.broker')->createToken($admin);
    	 $data = DB::table('password_resets')->insert([
    	 	'email'=>$admin->email,
    	 	'token'=>$token,
    	 	'created_at'=>Carbon::now(),
    	 	]);
    	 Mail::to($admin->email)->send(new AdminResetPassword(['data'=>$admin,'token'=>$token]));
    	 session()->flash("success",trans('admin.the_link_reset_sent'));
    	 return back();
    	 }
    	 return back();

    }


    public function reset_password($token)
    {
    	$check=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
    	if(!empty($check))
    	{
    		return view('admin.reset_password',['data'=>$check]);
    	}else{
    		return redirect(aurl('forget/password'));
    	}

    }



    public function confirm_password($token)
    {
    	$this->validate(request(),[
    		'password'=>'required|confirmed',
    		'password_confirmation'=>'required',
    	],[],[
    		'password'=>'Password',
    		'password_confirmation'=>'Confirm Password',
    	]);
    	$check=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
    	if(!empty($check))
    	{
    		$admin=Admins::where('email',$check->email)->update([
    			'email'=>$check->email,
    			'password'=>bcrypt(request('password'))
    		]);
    	DB::table('password_resets')->where('email',request('email'))->delete();
    	admin()->attempt(['email'=>$check->email,'password'=>request('password')],true);
    	return redirect(aurl());

    	}else{
    		return redirect(aurl('forget/password'));
    	}
    }
}
