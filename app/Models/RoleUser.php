<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

    protected $dates = ['deleted_at'];
    
    public static function updateOrInsert($roles,$user_id)
	{
		foreach($roles as $role){
			RoleUser::updateOrCreate(
				[ 'role_id' => $role, 'user_id' => $user_id ],
				[ 'role_id' => $role, 'user_id' => $user_id]
			);
		}
    }
    
    public static function listRoleEdit($user_id)
	{
		
    }
}
