<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TradMarks extends Model
{
    protected $table='tradmarks';
    protected $fillable = [
            'tradmark_name',
            'logo',
    ];
}
