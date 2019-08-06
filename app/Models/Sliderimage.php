<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use DB;
use App\Models\Slider;

class Sliderimage extends Model
{
    protected $table = 'sliderimages';
    protected $hidden = [];
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    
    public static function getItems()
    {
        $sliders = Sliderimage::get();
        return $sliders;
    } 

    public static function getItem($id)
    {
        $slider = Sliderimage::where('id',$id)->first();
        if($slider){
            return $slider;
        }
        return '';
    }

    public static function getItemByKey($key)
    {
        $slider = Sliderimage::where('key',$key)->first(['key']);
        if($slider){
            return $slider->key;
        }
        return '';
    }

    public static function updateStatus($status,$id)
    {
        $status = ($status == 'on') ? 0 : 1;
        $update = Sliderimage::where('id', $id)->update(['status' => $status ]);
        $msg = ($update) ? config('admin.update_succeeded') : config('admin.failed');
        return $msg;
    }

}
