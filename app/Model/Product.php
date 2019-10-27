<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $fillable = [
    	'title',
    	'photo',
    	'content',
    	'department_id',
	    'trad_id',
    	'mani_id',
    	'color_id',
    	'currency_id',
        'size',
        'size_id',
    	'price',
    	'stock',
    	'start_at',
    	'end_at',
    	'other_data',
    	'start_offer_at',
    	'end_offer_at',
    	'price_offer',
    	'weight',
    	'weight_id',
    	'status',
    	'reason',

    ];
    public function other_data()
    {
        return $this->hasMany(\App\Model\OtherDate::class,'product_id','id');
    }

    public function malls()
    {
        return $this->hasMany(\App\Model\MallProduct::class,'product_id','id');
    }

    public function files()
    {
        return $this->hasMany('App\File','relation_id','id')->where('file_type','product');
    }
}
