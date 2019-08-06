<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\PostRequest;
use App\Helpers\articleService;
use Session;

use App\Models\PostCategory;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->post = new Post;
        $this->menu = new Category;
        $this->postCategory = new PostCategory;
        $this->articleService = new articleService;
    }
    
    protected $title = 'Posts';

    public function index(Request $request)
    {
        return view('admins.posts.index',[
            'title'         => $this->title,
            'posts'         => $this->post->getItems( $this->item($request->item) ),
            'categories'    => Category::getListMenuByGroup()
        ]);                 
    }


    public function item($item){
		return ($item) ? $item : 10;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $uploadFile = $this->articleService->uploadFile('thumbnail','uploads/posts/');
        $post_id = Post::create([
            'title'             => strip_tags($request->title),
            'slug'              => strip_tags($request->slug),
            'status'            => ($request->status == 'on') ? 1:0,
            'content'           => strip_tags($request->content),
            'seo_title'         => strip_tags($request->seo_title),
            'seo_keywords'      => strip_tags($request->seo_keywords),
            'seo_description'   => strip_tags($request->seo_description),
            'description'       => strip_tags($request->description),
            'thumbnail'         => $uploadFile
        ])->id;
        if($post_id){
            $this->postCategory->updateOrInsert($request->category, $post_id);
            return redirect()->back()->with('update_succeeded',config('admin.update_succeeded'));
        }
        return redirect()->back()->with('failed',config('admin.dailed'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->post->getItem($id);
        if( !$post ){
            return view('admins.errors.404');
        }
        return view('admins.posts.edit',[
            'post'          => $post,
            'title'         => $this->title,
            'categories'    => $this->menu->getListMenuByGroupSelected($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
       
        $update = $this->post->getItem($id);
        
        if($update){
            $uploadFile = $this->articleService->uploadFile('thumbnail','uploads/posts/');
            if($uploadFile != ''){
                $this->articleService->delFile($update->thumbnail);
            }
            $update->title              = strip_tags($request->title);
            $update->slug               = strip_tags($request->slug);
            $update->status             = ($request->status == 'on') ? 1 : 0;
            $update->content            = strip_tags($request->content);
            $update->seo_title          = strip_tags($request->seo_title);
            $update->seo_keywords       = strip_tags($request->seo_keywords);
            $update->seo_description    = strip_tags($request->seo_description);
            $update->description        = strip_tags($request->description);
            $update->thumbnail          = ($uploadFile == '') ? $update->thumbnail : $uploadFile;
            $update->save();

            $this->postCategory->updateOrInsert($request->category,$id);
            $this->postCategory->delItemsByCatAndPost($request->category,$id);

            return redirect()->route('listposts.index')->with('update_succeeded',config('admin.update_succeeded') );
        }
        return redirect()->route('listposts.edit',[$id])->with('failed',config('admin.failed') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->post->getItem($id);
        if( ! $post){
            return redirect()->route('listposts.edit',[$id])->with( 'failed', config('admin.failed') );
        }

        $this->postCategory->delItemByPost($post->id);
        $comment = new Comment;
        $comment->delCommentsByPostId($post->id);
        $del = $post->delete();
        if($del){
            $this->articleService->delFile($post->thumbnail);
            return redirect()->route('listposts.index')->with('delete_succeeded', config('admin.delete_succeeded'));
        }

    }

    #======================Ajax====================#
    public function ajaxCheckSlug(Request $request)
    {
        $id = strip_tags($request->id);
        $slug = strip_tags($request->slug);
        if($id != ''){
            $check = Post::where('id','<>',$id)->where('slug',$slug)->first();
        }else{
            $check = $this->post->getItemBySlug($slug);
        }
        if($check) {
            return Response::json(array('msg' => 'true'));
        }
        return Response::json(array('msg' => 'false'));
    }

    public function  ajaxDel($id)
    {
        $post = $this->post->getItem($id);
        if($post){
            $this->postCategory->delItemByPost($id);
            $del = $post->delete();
            if($del){
                $this->articleService->delFile($post->thumbnail);
                return config('admin.delete_succeeded');
            }
        }
        return config('admin.failed');
    }

    public function ajaxStatus($id)
    {
        return $this->post->updateStatus($id);
    }

    public function ajaxSearch(Request $request)
    {
        $posts = $this->post->search(strip_tags($request->keywork));
        return view('admins.posts.search',compact('posts'));
    }

    
}
