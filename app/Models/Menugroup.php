<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menugroup extends Model
{
    
	protected $table = 'menugroups';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public function getMenugroups()
    {
        return $this->where('status',1)->get();
    }

    public function getItems()
    {
        return $this->get();
    }

    public function getItem($id)
    {
        $menuGroup =  $this->where('id',$id)->first();
        if($menuGroup){
            return $menuGroup;
        }
        return '';
    }

    public function getItemByKey($key)
    {
        $menuGroup =  $this->where('key',$key)->first();
        if($menuGroup){
            return $menuGroup;
        }
        return '';
    }

    public function delItem($id)
    {
        $delItem = $this->where('id',$id)->delete();
        $msg = ($delItem) ? config('admin.delete_succeeded') : config('admin.failed');
        return $msg;
    }

    public function updateStatus($id)
    {
        $menuGroup = $this->getItem($id);
        $status = ($menuGroup->status === 1) ? 0 : 1;
        $update = $this->where('id',$id)->update([ 'status' => $status ]);
        $msg = ($update) ? config('admin.update_succeeded') : config('admin.failed');
        return $msg;
    }
}
