<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Menulist;
use App\Models\Post;
use App\Models\Category;
use View;

class PostController extends PageController
{

    public function category($slug)
    {
       $category = Category::getItemByUrl($slug);
        if( !$category ){
            return view('homes.errors.404');
        }
        return view('homes.posts.category',[
            'posts' => Post::getPostsByCat($slug),
            'category'  => $category
        ]);
    }

    public function post($slug)
    {
        $post = Post::getPost($slug);
        if( !$post ){
            return view('homes.errors.404');
        }
        return view('homes.posts.post',[
            'post' => $post,
        ]);
    }
    
    
}
