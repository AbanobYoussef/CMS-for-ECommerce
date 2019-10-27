<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='files';
    protected $fillable = [
         'name',
         'size',
         'file',
         'path',
         'full_file',
         'mime_type',
         'file_type',
         'relation_id',
    ];

}
