<?php

Route::group(['middleware'=>'Maintenance'], function () {
    Route::get('/', function () {
    return view('style.Home');
	});
});


Route::get('maintenance', function () {
    return view('style.maintenance');
	});
