<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\File;

class Upload extends Controller
{
    public static function upload($data=[])
    {
     	if(in_array('new_name', $data))
     	{
     		$new_name=$data['new_name']===null?time():$data['new_name'];
     	}
     	if(request()->hasFile($data['file'])&&$data['upload_type']=='single')
     	{
     		if(in_array('delete_file', $data))
            {
                \Storage::has($data['delete_file'])?\Storage::delete($data['delete_file']):'';
            }
			return request()->file($data['file'])->store($data['path']);
     	}
        elseif (request()->hasFile($data['file'])&&$data['upload_type']=='files') {
            $file=request()->file($data['file']);
            $size=$file->getSize();
            $mime_type=$file->getMimeType();
            $name=$file->getClientOriginalName();
            $hashName=$file->hashName();

            $file->store($data['path']);
            $add=File::create([
                 'name'=>$name,
                 'size'=>$size,
                 'file'=>$hashName,
                 'path'=>$data['path'],
                 'full_file'=>$data['path'].'/'.$hashName,
                 'mime_type'=>$mime_type,
                 'file_type'=>$data['file_type'],
                 'relation_id'=>$data['relation_id'],
            ]);
            return $add->id;
        }
    }


    public function delete($id)
    {
        $file=File::find($id);
        if(!empty($file))
        {
            \Storage::delete($file->full_file);
            $file->delete();
        }

    }
}
