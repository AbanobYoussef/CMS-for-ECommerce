<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manifactories extends Model
{
    protected $table='manifactories';
    protected $fillable = [
    	'Mani_name',
    	'email',
    	'mobile',
    	'facebook',
    	'twitter',
    	'website',
    	'contact_name',
    	'lat',
    	'lag',
    	'logo',

    ];
}
