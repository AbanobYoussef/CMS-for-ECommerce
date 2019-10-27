<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    protected $table='malls';
    protected $fillable = [
    	'Mall_name',
    	'email',
        'country_id',
    	'mobile',
    	'facebook',
    	'twitter',
    	'website',
    	'contact_name',
    	'lat',
    	'lag',
    	'logo',

    ];

     public function country_id()
    {
        return $this->hasOne('App\Model\Country','id','country_id');
    } 
}
