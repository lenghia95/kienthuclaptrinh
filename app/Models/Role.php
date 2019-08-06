<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

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
