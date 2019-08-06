<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use DB;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $hidden = [];
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public static function getItems()
    {
        $contacts = Contact::get();
        return $contacts;
    } 

    public  function getItem($id)
    {
        $contact = Contact::where('id',$id)->first();
        if($contact){
            return $contact;
        }
        return '';
    }

    // public static function updateStatus($status,$id)
    // {
    //     $status = ($status == 'on') ? 0 : 1;
    //     $update = Contact::where('id', $id)->update(['status' => $status ]);
    //     $msg = ($update) ? config('admin.update_succeeded') : config('admin.failed');
    //     return $msg;
    // }

    public  function updateStatus($id)
    {
        $contact = $this->getItem($id);
        $status = ($contact->status === 1) ? 0 : 1;
        $update = Contact::where('id', $id)->update(['status' => $status ]);
        $msg = ($update) ? config('admin.update_succeeded') : config('admin.failed');
        return $msg;
    }

    public static function delItem($id)
    {
        $delItem = Contact::where('id',$id)->delete();
        return $delItem;
    }
}
