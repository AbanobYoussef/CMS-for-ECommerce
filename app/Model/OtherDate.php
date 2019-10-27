<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OtherDate extends Model
{
	 protected $table='other_dates';
    protected $fillable = [
            'product_id',
            'data_key',
            'data_value',
    ];
}
