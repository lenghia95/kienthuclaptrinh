<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostCategory extends Model
{
    
	
	protected $table = 'post_categories';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];


	/*============================== Admin ================================= */
	public static function getItemsByCat($category_id)
	{
		$arCats = [];
		$cats_id =  PostCategory::where('category_id',$category_id)->get();
		foreach($cats_id as $key => $value){
			$arCats[$key] = $value->post_id;
		}
		return $arCats;
	}

	public static function getItemsByPost($post_id)
	{
		$arPosts = [];
		$posts_id =  PostCategory::where('post_id',$post_id)->get('post_id');
		foreach($posts_id as $key => $value){
			$arPosts[$key] = $value->post_id;
		}
		return $arPosts;
	}

	#=========Admin and Frontend=============#
    public static function getCatsByPostId($id)
	{
		$cat = DB::table('posts as p')
		->join('post_categories as pc','p.id','=','pc.post_id')
		->join('categories as c','pc.category_id','=','c.id')
		->where('p.id',$id)
		->select('c.name','c.id','c.slug')
		->get();
		return $cat;
	}
	#=========Admin and Frontend=============#

	
	public static function updateOrInsert($cats,$post_id)
	{
		foreach($cats as $cat){
			PostCategory::updateOrCreate(
				[ 'category_id' => $cat, 'post_id' => $post_id ],
				[ 'category_id' => $cat, 'post_id' => $post_id]
			);
		}
	}

	public function updateByCat($category_id,$parent)
	{
		if($parent){
			PostCategory::where('category_id',$category_id)->update(['category_id'=>$parent]);
		}
	}

	public static function delItemsByCatAndPost($cats,$post_id)
	{
		PostCategory::where('post_id',$post_id)->whereNotIn('category_id',$cats)->delete();
	}

	public function delItemByPost($post_id)
	{
		PostCategory::whereIn('post_id',$this->getItemsByPost($post_id))->delete();
	}

	public function delItemByCat($category_id)
	{
		PostCategory::whereIn('category_id',$this->getItemsByCat($category_id))->delete();
	}
}
