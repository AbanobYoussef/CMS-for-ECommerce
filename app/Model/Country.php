<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table='countries';
    protected $fillable = [
            'country_name',
            'mod',
            'code',
            'logo',
            'currency',
    ];


    public function malls()
    {
        return $this->hasMany('App\Model\Mall','country_id','id');
    }
}
