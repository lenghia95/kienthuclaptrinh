<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use DB;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $hidden = [];
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public static function getItems()
    {
        $sliders = Slider::get();
        return $sliders;
    } 

    public static function getItem($id)
    {
        $slider = Slider::where('id',$id)->first();
        if($slider){
            return $slider;
        }
        return '';
    }

    public static function getItemByKey($key)
    {
        $slider = Slider::where('key',$key)->first(['key']);
        if($slider){
            return $slider->key;
        }
        return '';
    }

    public function updateStatus($id)
    {
        $slider = $this->getItem($id);
        $status = ($slider->status === 1) ? 0 : 1;
        $update = Slider::where('id', $id)->update(['status' => $status ]);
        $msg = ($update) ? config('admin.update_succeeded') : config('admin.failed');
        return $msg;
    }

}
