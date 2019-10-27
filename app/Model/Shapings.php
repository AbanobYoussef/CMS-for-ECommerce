<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shapings extends Model
{
    protected $table='shapings';
    protected $fillable = [
    	'name',
    	'user_id',
    	'lat',
    	'lag',
    	'logo',

    ];


    public function user_id()
    {
      
        return $this->hasOne('App\User','id','user_id');
    }
}
