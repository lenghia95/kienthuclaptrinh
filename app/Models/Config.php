<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'configs';

    protected $fillable = [
        "key", "value"
    ];

    protected $hidden = [

    ];

    var $skin_array = [
        'White Skin' => 'skin-white',
        'Blue Skin' => 'skin-blue',
        'Black Skin' => 'skin-black',
        'Purple Skin' => 'skin-purple',
        'Yellow Sking' => 'skin-yellow',
        'Red Skin' => 'skin-red',
        'Green Skin' => 'skin-green'
    ];

    var $layout_array = [
        'Fixed Layout' => 'fixed',
        'Boxed Layout' => 'layout-boxed',
        'Top Navigation Layout' => 'layout-top-nav',
//        'Sidebar Collapse Layout' => 'sidebar-collapse',
        'Sidebar Collapse Layout' => 'sidebar-coll',
        'Mini Sidebar Layout' => 'sidebar-mini'
    ];

    // LAConfigs::getByKey('sitename');
    public static function getByKey($key) {
        $row = Config::where('key',$key)->first();
        if(isset($row->value)) {
            return $row->value;
        } else {
            return false;
        }
    }

    // LAConfigs::getAll();
    public static function getItems() {
        $configs = array();
        $configs_db = Config::get();
        foreach ($configs_db as $row) {
            $configs[$row->key] = $row->value;
        }
        return (object) $configs;
    }

    public static function updateConfig($all)
    {
        foreach(['sidebar_search', 'show_messages', 'show_notifications', 'show_tasks', 'show_rightsidebar'] as $key) {
            if(!isset($all[$key])) {
                $all[$key] = 0;
            } else {
                $all[$key] = 1;
            }
        }
        foreach($all as $key => $value) {
            Config::where('key', $key)->update(['value' => $value]);
        }
        
    }
}
