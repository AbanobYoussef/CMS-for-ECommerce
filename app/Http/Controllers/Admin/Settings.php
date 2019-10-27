<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Setting;
use Up;
class Settings extends Controller {

	public function setting() {
		return view('admin.settings', ['title' => 'Settings Control']);
	}

	public function setting_save() {
		$data=$this->validate(request(),[

			'logo'=>v_image(),
			'icon'=>v_image(),
			'email'=>'',
			'description'=>'',
			'description'=>'',
			'keywords'=>'',
			'message_maintenance'=>'',
			'status'=>'',
			

		],[],[

			'logo'=>'Logo',
			'icon'=>'Icon',
		]);
		if(request()->hasfile('logo'))
		{
			$data['logo']=up()->upload([
				'file'=>'logo',
				'path'=>'setting',
				'upload_type'=>'single',
				'delete_file'=>setting()->logo,

			]);
		}
		if(request()->hasfile('icon'))
		{
			$data['icon']=up()->upload([
				'file'=>'icon',
				'path'=>'setting',
				'upload_type'=>'single',
				'delete_file'=>setting()->icon,

			]);
		}
		Setting::orderBy('id', 'desc')->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('settings'));
	}
}
