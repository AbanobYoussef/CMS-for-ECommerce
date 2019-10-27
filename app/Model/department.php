<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
     protected $table='departments';
    protected $fillable = [
    		'dep_name',
    		'icon',
    		'description',
    		'keywords',
    		'parent',

    ];


    public function parents()
    {
    	return $this->hasMany('App\Model\Country','id','parent');
    } 
 
}
