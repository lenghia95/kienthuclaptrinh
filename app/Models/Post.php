<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\PostCategory;

class Post extends Model
{
	protected $table = 'posts';
	protected $hidden = [];
	protected $guarded = [];
	protected $dates = ['deleted_at'];
    /*============================== Admin ================================= */
	public function getItems()
	{
		$posts = DB::table('posts as p')
		->join('post_categories as pc','p.id','=','pc.post_id')
		->join('users as u','p.author','=','u.id')
		->groupBy('p.id')
		->select('p.id', 'title', 'author', 'p.created_at','thumbnail','u.username as uName', 'p.status')
		->get();
		return $posts;
	}

	public function getItem($id)
	{
		$post = Post::where('id',$id)->first();
        if($post){
            return $post;
        }
        return '';
	}

	public function updateStatus($id)
    {
        $post = $this->getItem($id);
        $status = ($post->status === 1) ? 0 : 1;
        $update = $this->where('id',$id)->update([ 'status' => $status ]);
        $msg = ($update) ? config('admin.update_succeeded') : config('admin.failed');
        return $msg;
	}

	public function getItemBySlug($slug)
    {   
        $menu = Post::where('slug', $slug)->first();
        if($menu){
            return $menu;
        }
        return '';
    }


    #=====================Frontend==================#

    public function comments()
	{
	    return $this->hasMany('App\Models\Comment');
	}

    public static function getPostsByCat($slug)
    {	
    	$posts = Post::with('comments')
		->join('post_categories as pc','posts.id','=','pc.post_id')
		->join('categories as c','c.id','=','pc.category_id')
		->join('users as u','posts.author','=','u.id')
		->where('c.slug', $slug)->where('posts.status', 1)
		->groupBy('posts.id')
		->orderBy('posts.id', 'desc')
		->select('posts.id', 'title', 'c.name',  'posts.created_at','thumbnail','u.username as uName', 'posts.status','posts.content', 'posts.description', 'posts.slug', 'views')
		->paginate(10);
		return $posts;
	}
	
	public static function getPostByCat($slug)
    {	
    	$post = Post::with('comments')
		->join('post_categories as pc','posts.id','=','pc.post_id')
		->join('categories as c','c.id','=','pc.category_id')
		->join('users as u','posts.author','=','u.id')
		->where('c.slug', $slug)->where('posts.status', 1)
		->groupBy('posts.id')
		
		->select('posts.id', 'title', 'c.name',  'posts.created_at','thumbnail','u.username as uName', 'posts.status','posts.content', 'posts.description', 'posts.slug', 'views')
		->first();
		return ($post) ? $post : false;
    }

    public static function getPosts($keyword = '')
    {	
    	$posts = Post::with('comments')
		->join('post_categories as pc','posts.id','=','pc.post_id')
		->join('categories as c','c.id','=','pc.category_id')
		->join('users as u','posts.author','=','u.id')
		->where('posts.status',1);
		if($keyword != ''){
			$posts->where('posts.title','like',"%$keyword%")
			->orWhere('posts.description','like',"%$keyword%");
		}
		$posts = $posts->groupBy('posts.id')
		->orderBy('posts.id','desc')
		->select('posts.id', 'title', 'c.name', 'c.slug as cSlug', 'posts.created_at','thumbnail','u.username as uName', 'posts.status','posts.content','posts.slug', 'views', 'posts.description')
		->paginate(15);
		return $posts;
    }

	public static function getPost($slug)
    {	
    	$post = Post::with('comments')
		->join('post_categories as pc','posts.id','=','pc.post_id')
		->join('categories as c','c.id','=','pc.category_id')
		->join('users as u','posts.author','=','u.id')
		->where('posts.slug',$slug)
		->groupBy('posts.id')
		->select('posts.id', 'c.name as cName', 'c.slug as cSlug', 'title', 'posts.created_at','thumbnail','u.username as uName', 'posts.status','posts.content','posts.slug', 'views', 'posts.description')
		->first();
		return ($post) ? $post : false;
	}

	public static function getPostsRelate($slug, $cat)
    {	
    	$posts = Post::with('comments')
		->join('post_categories as pc','posts.id','=','pc.post_id')
		->join('categories as c','c.id','=','pc.category_id')
		->join('users as u','posts.author','=','u.id')
		->where('posts.slug', '<>', $slug)->where('c.slug', $cat)
		->groupBy('posts.id')
		->select('posts.id', 'c.name as cName', 'c.slug as cSlug', 'title', 'posts.created_at','thumbnail','u.username as uName', 'posts.status','posts.content','posts.slug', 'views', 'posts.description')
		->limit(10)->get();
		return $posts;
	}
	
	public static function getPostManyViews()
    {	
    	$post = Post::with('comments')
		->join('post_categories as pc','posts.id','=','pc.post_id')
		->join('categories as c','c.id','=','pc.category_id')
		->join('users as u','posts.author','=','u.id')
		->where('posts.status',1)
		->orderBy('views', 'desc')
		->groupBy('posts.id')
		->select('posts.id', 'c.name as cName', 'c.slug as cSlug', 'title', 'posts.created_at','thumbnail','u.username as uName', 'posts.status','posts.content','posts.slug', 'views', 'posts.description')
		->get();
		return ($post) ? $post : false;
    }
}
