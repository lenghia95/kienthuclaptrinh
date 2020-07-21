<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model
{
    protected $table = 'roles';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

    public static function getItems()
    {
        $roles = Role::get();
        return $roles;
    }

	public static function getItem($id)
    {
        $role = Role::where('id',$id)->first();
        return ($role) ? $role : false;
    }

    public static function getRoleByUserId($id)
	{
		$cat = DB::table('users as u')
		->join('role_user as ru','u.id','=','ru.user_id')
		->join('roles as r','ru.role_id','=','r.id')
		->where('u.id',$id)
		->select('r.name','r.id','r.display_name')
		->get();
		return $cat;
    }
    
    public static function getListOptionRole($roleJson) {
        $roleArr = json_decode($roleJson);
        $roles = Role::get();
        $html = '';
        if ($roles) {
            foreach ($roles as $role) {
                $selected = (in_array($role->id, $roleArr)) ? 'selected= "selected"' : '';
                $html .= "<option value='" . $role->id . "' " . $selected . " >". $role->name . "</option>";
            }
        }
        return $html;
    }
}
