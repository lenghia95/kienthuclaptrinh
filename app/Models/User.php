<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	
	protected $table = 'users';
	protected $hidden = [ ];
	protected $guarded = [];
	protected $dates = ['deleted_at'];

	public function getItem($id){
		return User::where('id',$id)->first();
	}

    public function getItemByEmail($email)
    {
        return User::where('email',$email)->first();
    }

    public function getItems(){
        return User::get();
    }

	public  function updateStatus($id)
    {
        $user = $this->getItem($id);
        $status = ($user->status == 1) ? 0 : 1;
        $update = User::where('id', $id)->update(['status' => $status ]);
        $msg = ($update) ? config('admin.update_succeeded') : config('admin.failed');
        return $msg;
    }
}
