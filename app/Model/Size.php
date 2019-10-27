<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    protected $table='size';
    protected $fillable = [
    	'name',
        'department_id',
        'is_public',
    ];


     public function department_id()
    {
    	return $this->hasOne('App\Model\department','id','department_id');
    } 
}
