<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;
use Storage;

class FileUpload extends Model
{
     public static function photo($request,$filename,$default="")
     {

     	$name="";
     	$photo=$request->photo;
     	If($request->hasFile($fileName))
     	{
     		$extension=$photo->getClientOriginalExtension();
     		$name=rand(11111,99999).".".date('Y-m-d').".".time().".".$extension;
     		 Storage::disk('photo')->put($name,File::get($photo));
     		 $name=$name;
     	}else{
     		$name=$default;
     	}
     	return $name;
     }
}
