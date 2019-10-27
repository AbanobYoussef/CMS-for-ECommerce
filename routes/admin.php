<?php

Route::group(['prefix'=>'admin','namespace'=>'Admin'], function () {
	Config::set('auth.defualt','webadmin');

		
	     Route::get('login','AdminAuth@login');

		Route::post('login','AdminAuth@dOlogin');

		Route::get('forget/password','AdminAuth@forget_password');

		Route::post('forget/password','AdminAuth@forget_password_post');

		Route::get('rest/password/{token}','AdminAuth@reset_password');

		Route::post('rest/password/{token}','AdminAuth@confirm_password');

	     
		 Route::group(['middleware'=>'admin:webadmin'], function () {


		 	Route::resource('admin','AdminController');
		 	Route::delete('admin/destory/all','AdminController@muilt_all');

		 	Route::resource('countries','CountriesController');
		 	Route::delete('countries/destory/all','CountriesController@muilt_all');


		 	Route::resource('cities','CitiesController');
		 	Route::delete('cities/destory/all','CitiesController@muilt_all');


		 	Route::resource('users','UsersController');
		 	Route::delete('users/destory/all','UsersController@muilt_all');



		 	Route::resource('states','StatesController');
		 	Route::delete('states/destory/all','StatesController@muilt_all');

		 	Route::resource('tradMarks','TrandMarksController');
		 	Route::delete('tradMarks/destory/all','TrandMarksController@muilt_all');



		 	
		 	Route::resource('manifactories','ManifactoriesController');
		 	Route::delete('manifactories/destory/all','ManifactoriesController@muilt_all');


		 	Route::resource('shapings','ShapingsController');
		 	Route::delete('shapings/destory/all','ShapingsController@muilt_all');


		 	Route::resource('malls','MallsController');
		 	Route::delete('malls/destory/all','MallsController@muilt_all');

		 	Route::resource('colors','ColorsController');
		 	Route::delete('colors/destory/all','ColorsController@muilt_all');



		 	Route::resource('size','SizeController');
		 	Route::delete('size/destory/all','SizeController@muilt_all');


		 	Route::resource('weights','WeightsController');
		 	Route::delete('weights/destory/all','WeightsController@muilt_all');


		 	Route::resource('products','ProductsController');
		 	Route::delete('products/destory/all','ProductsController@muilt_all');
		 	Route::post('upload/image/{pid}','ProductsController@upload_file');
		 	Route::post('delete/image','ProductsController@delete_file');


		 	Route::post('upload/product/image/{pid}','ProductsController@upload_product_image');
		 	Route::post('delete/product/image/{pid}','ProductsController@delete_product_image');


		 	Route::post('load/weight/size','ProductsController@prepare_weights_size');



		 	Route::resource('departments','DepartmentsController');


		 	Route::get('settings', 'Settings@setting');
				Route::post('settings', 'Settings@setting_save');

		 	//Route::get('open','AdminController@anyData');
	     Route::get('/', function () {
	    return view('admin.Home');
	   });


	     Route::any('logout', 'AdminAuth@logout');

});


});