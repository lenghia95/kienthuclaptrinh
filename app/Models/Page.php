<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	protected $table = 'pages';
	protected $hidden = [];
	protected $guarded = [];
	protected $dates = ['deleted_at'];

	public function getItems()
	{
		return Page::get();
	}

	public function getItem($id)
	{
		return Page::where('id',$id)->first();
	}

	public function delItem($id)
	{
		$del = Page::where('id',$id)->delete();
		//$msg = ($del) ? config('admin.delete_succeeded') : config('admin.failed');
		return ($del) ? $del : '';
	}



	#=====================FrontEnd==================#

	public static function getPageBySlug($slug)
	{
		$page = Page::where('slug', $slug)->first();
		return ($page) ? $page : false;
	} 
}
