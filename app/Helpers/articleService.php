<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class articleService
{
    public function uploadFile($key,$path)
    {
        if(request()->hasFile($key)){
            $duoiFile = request()->file($key)->getClientOriginalExtension();
            $fileName = 'blogs-'.time().Str::random(3).'.'.$duoiFile;
            request()->file($key)->move(public_path($path), $fileName);
            return $path.$fileName;
        }
        return '';
    } 

    public function delFile($file)
    {
        if ( !empty($file) )
        {
            $path = base_path('public/'.$file);
            @unlink($path);
        }
        
    }
}
