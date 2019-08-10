<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use DB;
use Auth;

class Comment extends Model
{
    protected $table = 'comments';
    protected $hidden = [];
    protected $guarded = [];
    protected $dates = ['deleted_at'];


    #======================Admin====================#
    public static function getItems()
    {
        $comments = DB::table('comments as c')->join('users as u','c.user_id','=','u.id')
        ->join('posts as p','c.post_id','=','p.id')
        ->select('c.id','title', 'fullname','email','c.status','parent','c.content','c.created_at')->get();
        return $comments;
    } 

    public static function getItemReply($parent)
    {
        $comment = DB::table('comments as c')->join('users as u','c.user_id','=','u.id')
        ->join('posts as p','c.post_id','=','p.id')->where('c.id',$parent)
        ->select('c.id','title', 'fullname','email','c.status','parent','c.content','c.created_at')->first();
        if($comment){
            return $comment;
        }
        
       return '';
    } 
    
    public  function getItem($id)
    {
        $comment = DB::table('comments as c')->join('users as u','c.user_id','=','u.id')
        ->join('posts as p','c.post_id','=','p.id')->where('c.id',$id)
        ->select('c.id','title', 'c.post_id', 'fullname', 'u.id as uId', 'avatar', 'email','c.status','parent','c.content','c.created_at','c.updated_at')->first();
        if($comment){
            return $comment;
        }
    }

    public  function updateStatus($id)
    {
        $contact = $this->getItem($id);
        $status = ($contact->status === 1) ? 0 : 1;
        $update = Comment::where('id', $id)->update(['status' => $status ]);
        $msg = ($update) ? config('admin.update_succeeded') : config('admin.failed');
        return $msg;
    }

    public function getItemsById($id){
        $comments = Comment::where('parent',$id)->get();
        return $comments;
    }

    public function delItem($id){
        return Comment::where('id',$id)->delete();
    }

    public function delItemById($id){
        foreach($this->getItemsById($id) as $comment){
            $del = $this->delItem($comment->id);
        }
        $del = $this->delItem($id);
        return $del;
    }

    public function delComments($id)
    {
        $comment = $this->getItem($id);
        $delItem = ($comment->parent != 0 ) ? $this->delItem($comment->id) : $this->delItemById($id);
        return $delItem;
    }

    #==============delete comments by post_id ============#
    public function getCommentsByPostId($post_id)
    {
        $comments = Comment::where('post_id',$post_id)->get();
        return $comments;
    }

    public function postsId($comments)
    {
        $arrId = [];
        foreach($comments as $key => $value){
            $arrId[$key] = $value->post_id;
        }
        return $arrId;
    }
    public function delCommentsByPostId($post_id)
    {
        Comment::whereIn('post_id',$this->postsId($this->getCommentsByPostId($post_id)))->delete();
    }
    #==============end delete comments by post_id ============#



    #======================Homes====================#

    public function getCommentsByPostIdParent($post_id)
    {
        $comments = DB::table('comments as c')->join('users as u','c.user_id','=','u.id')
        ->join('posts as p','c.post_id','=','p.id')->where('c.post_id',$post_id)->where('parent',0)->where('c.status',1)
        ->select('c.id','title', 'avatar', 'fullname','email','c.status','parent','c.content','c.created_at','c.updated_at')
        ->get();
        return $comments;
    }

    public static function getCommentsByParent($parent)
    {
        $comments = DB::table('comments as c')->join('users as u','c.user_id','=','u.id')
        ->join('posts as p','c.post_id','=','p.id')->where('parent',$parent)->where('c.status',1)
        ->select('c.id','title', 'avatar', 'fullname', 'u.id as uId', 'email','c.status','parent','c.content','c.created_at','c.updated_at')
        ->get();
        return $comments;
    }

    public static function addComment($arrContent){
        $addComment = Comment::create($arrContent);
        return $addComment;
    }
}
