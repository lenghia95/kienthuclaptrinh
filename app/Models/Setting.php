<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use DB;

class Setting extends Model
{
    protected $table = 'settings';
    protected $hidden = [];
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public static function listOptions()
    {
        $options = array();
        $options['tabs'] = [
            [
                'id' => 'picture',
                'title' => 'Picture',
                'icon' => 'fa-image'
            ],[
                'id' => 'company',
                'title' => 'Company',
                'icon' => 'fa-building'
            ],[
                'id' => 'social',
                'title' => 'Social Network',
                'icon' => 'fa-facebook'
            ],[
                'id' => 'copyright',
                'title' => 'Copyright',
                'icon' => 'fa-copyright'
            ],[
                'id' => 'status',
                'title' => 'Web Status',
                'icon' => 'fa-cog'
            ],
        ];
        $options['content']['company'] = [
            [
                'id'=>'company_name',
                'type'=>'text',
                'title'=>'Company Name',
                'value'=> ''

            ],[
                'id'=>'company_address',
                'type'=>'text',
                'title'=>'Company Address',
                'value'=> ''
            ],[
                'id'=>'company_about',
                'type'=>'textarea',
                'title'=>'Company About short',
                'value'=> ''
            ],[
                'id'=>'company_email',
                'type'=>'text',
                'title'=>'Company Email',
                'value'=> ''
            ],[
                'id'=>'company_phone',
                'type'=>'text',
                'title'=>'Company Phone',
                'value'=> ''
            ],[
                'id'=>'company_hotline',
                'type'=>'text',
                'title'=>'Company hotline',
                'value'=> ''
            ],[
                'id'=>'company_fax',
                'type'=>'text',
                'title'=>'Company fax',
                'value'=> ''
            ]
        ];

        $options['content']['picture'] = [
            [
                'id'=>'logo',
                'type'=>'file',
                'title'=>'Company Logo',
                'value'=> ''
            ],[
                'id'=>'logo_50',
                'type'=>'file',
                'title'=>'Company Logo with 50px',
                'value'=> ''
            ],[
                'id'=>'favicon',
                'type'=>'file',
                'title'=>'Company Favicon',
                'value'=> ''
            ]
        ];

        $options['content']['social']=[
            [
                'id' => 'facebook',
                'title' => 'Facebook',
                'type' => 'text',
                'value'=> ''
            ],[
                'id' => 'instagram',
                'title' => 'Instagram',
                'type' => 'text',
                'value'=> ''
            ],[
                'id' => 'youtube',
                'title' => 'Youtube',
                'type' => 'text',
                'value'=> ''
            ],[
                'id' => 'googleplus',
                'title' => 'Google +',
                'type' => 'text',
                'value'=> ''
            ],[
                'id' => 'linkedin',
                'title' => 'Linkedin network',
                'type' => 'text',
                'value'=> 'linkedin'
            ],[
                'id' => 'twitter',
                'title' => 'Twitter network',
                'type' => 'text',
                'value'=> 'twitter'
            ],[
                'id' => 'pinterest',
                'title' => 'Pinterest network',
                'type' => 'text',
                'value'=> 'pinterest'
            ]
        ];

        $options['content']['copyright'] = [
            [
                'id'=>'copyright',
                'type'=>'text',
                'title'=>'Copyright text',
                'value'=> ''

            ]
        ];

        $options['content']['status']=[
            [
                'id' => 'web_status',
                'title' => 'Website Status',
                'type' => 'select',
                'value' => ['off'=>'OFFLINE', 'on' => 'ONLINE']
            ]
        ];

        return $options;
    }

    public static function getValue($key = '', $default){
        $set = self::where('key',$key)->first();
        if($set)
        {
            return $set->value;
        }
        if( is_array($default))
        {
            return reset($default);
        }
        return $default;
    }

    public static function getSetting($key)
    {
        $first = DB::table('settings')->where('key', $key)->select('key','value')->first();
        return $first;
    }

    public static function addItem($key, $value)
    {
        DB::table('settings')->insert(['key' => $key, 'value' => $value ] );
    }

    public static function updateItem($key, $value)
    {
        DB::table('settings')->where('key', $key)->update(['value' => $value ]);
    }

    public static function updateOrstore($key, $value)
    {
        if (! self::getSetting($key) ) {
            self::addItem($key, $value);
        } else {
            self::updateItem($key, $value);
        }
        
    }
}
