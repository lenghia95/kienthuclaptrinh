<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Menulist;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use View;
use Auth;
use Session;

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
            'category'  => $category,
            'pagetitle'  => 'Học '.$category->name.' - Lập trình '.$category->name.' - Tự học '.$category->name
        ]);
    }

    public function post($slug)
    {
        
        $post = Post::getPost($slug);
        if( !$post ){
            return view('homes.errors.404');
        }
        $this->removeSessionViews($post);
        $this->viewCount($post);

        $postsRelate = Post::getPostsRelate($post->slug, $post->cSlug);
        $comment = new Comment;
        $comments = $comment->getCommentsByPostIdParent($post->id);
        return view('homes.posts.post',[
            'post'          => $post,
            'comments'      => $comments,
            'pagetitle'     => $post->title,
            'postsRelate'   => $postsRelate
        ]);
    }
    
    public function viewCount($post){
        $sessionView = Session::get('view_count'.$post->id);
        if (!$sessionView) { 
            $post->increment('views');
            Session::put('view_count'.$post->id, time()); 
        }
        return Session::get('view_count'.$post->id);
    }

    public function removeSessionViews($post)
    {
        $check = time() - Session::get('view_count'.$post->id);
        $session = ($check > 3600) ? Session::forget('view_count'.$post->id) : Session::get('view_count'.$post->id);
        return $session;
    }


    #=======================Ajax comment===================#
    public function comment(Request $request)
    {
        $post_id = strip_tags($request->post_id);
        $content = htmlspecialchars($request->content);
        $arrContent = [
            'content'   => $content,
            'post_id'   => $post_id,
            'user_id'  => Auth::user()->id,
        ];
        $comment_id = Comment::addComment($arrContent)->id;
        if($comment_id){
            return $this->showComment($comment_id);
        }
       
        
    }

    public function showComment($id)
    {
        $comment = new Comment;
        $itemComment = $comment->getItem($id);
        if($itemComment){
            return '<div class="media mb-2 comment-parent comment-'. $itemComment->id .'">
                        <img class="d-flex mr-2 border rounded comment-avatar" src="'.( ( !empty($itemComment->avatar) ) ? asset($itemComment->avatar) : asset('uploads/users/user.png') ).'" alt="'. $itemComment->fullname .'" title="'. $itemComment->fullname .'">
                        <div class="media-body comment-body">
                        <div class="card bg-light p-2 card-edit-'.$itemComment->id.'">
                            <div class="comment-content-'.$itemComment->id.'">
                                <h5 class="mt-0">'. $itemComment->fullname .'</h5>
                                <div class="comment-body-content">'. $itemComment->content .'</div>
                            </div>
                            <div class="form-edit-'.$itemComment->id.'"></div>
                        </div>
                        <div>
                            <ul class="list-inline mb-1 comment-action">
                                <li class="list-inline-item">
                                    <a class="reply" data-scrollto="#reply'. $itemComment->id .'" data-toggle="collapse" data-pell="'. $itemComment->id .'" href="#reply'. $itemComment->id .'" role="button" aria-expanded="false" aria-controls="reply'. $itemComment->id .'"><i class="fa fa-reply" aria-hidden="true"></i> Trả lời</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript:void(0)" data-id="'. $itemComment->id .'" class="reply delete-comment"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript:void(0)" data-id="'. $itemComment->id .'" class="reply edit-comment"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a>
                                </li>
                                <li class="list-inline-item">1 phút</li>
                            </ul>
                        </div>
                        <div class="comment-children'.$itemComment->id.' comment-child">
                        </div>
                        <div class="collapse mb-1" id="reply'.$itemComment->id.'">
                            <form method="POST" action="javascript:void(0)" accept-charset="UTF-8" class="postAjax" id="comment-reply">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="post" value="'.$itemComment->post_id.'">
                                <input type="hidden" name="comment" value="'.$itemComment->id.'">
                                <div class="form-group">
                                    <textarea class="form-control comment" name="content" rows="1" placeholder="Nhập nội dung bình luận..."></textarea>
                                </div>
                                <input type="reset" class="d-none">
                            </form>
                        </div>
                    </div>';
        }
        return '';
    }

    public function commentReply(Request $request)
    {
        $post_id = strip_tags($request->post_id);
        $content = htmlspecialchars($request->content);
        $comment_id = strip_tags($request->comment_id);
        $arrContent = [
            'content'   => $content,
            'post_id'   => $post_id,
            'parent'    => $comment_id,
            'user_id'  => Auth::user()->id,
        ];
        $comment_id = Comment::addComment($arrContent)->id;
        if($comment_id){
            return $this->showCommentReply($comment_id);
        }
    }

    public function showCommentReply($id)
    {
        $comment = new Comment;
        $itemComment = $comment->getItem($id);
        if($itemComment){
            return '<div class="media mb-2 comment-'. $itemComment->id.'" id="comment'.$itemComment->id.'"><img class="d-flex mr-2 border rounded comment-avatar" src="'.( ( !empty($itemComment->avatar) ) ? asset($itemComment->avatar) : asset('uploads/users/user.png') ).'" alt="'. $itemComment->fullname .'" title="'. $itemComment->fullname .'">
                    <div class="media-body">
                        <div class="card bg-light p-2 card-edit-'.$itemComment->id.'">
                            <div class="comment-content-'.$itemComment->id.'">
                                <h5 class="mt-0">'. $itemComment->fullname .'</h5>
                                <div class="comment-body-content">'. $itemComment->content .'</div>
                            </div>
                            <div class="form-edit-'.$itemComment->id.'"></div>
                        </div>
                        <ul class="list-inline mb-1 comment-action">
                            <li class="list-inline-item">
                                <a class="reply" data-scrollto="#reply'.$itemComment->id.'" data-toggle="collapse" data-pell="'.$itemComment->id.'" href="#reply'.$itemComment->id.'" role="button" aria-expanded="false" aria-controls="reply'.$itemComment->id.'"><i class="fa fa-reply" aria-hidden="true"></i> Trả lời</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript:void(0)" data-id="'. $itemComment->id .'" class="reply delete-comment"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript:void(0)" data-id="'. $itemComment->id .'" class="reply edit-comment"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a>
                            </li>
                            <li class="list-inline-item">1 phút</li>
                        </ul>
                    </div></div>';
        }
        return '';
        
    }

    public function deleteComment(Request $request)
    {
        if(!Auth::check()){
            return '';
        }
        $job = new Comment;
        $comment = $job->getItem($request->comment_id);
        if(!$comment && $comment->uId != Auth::user()->id){
            return '';
        }
        $del = $job->delItem($comment->id);
        if($del){
            return $comment->id;
        }
    }

    public function updateComment(Request $request)
    {
        if(!Auth::check()){
            return '';
        }
        $job = new Comment;
        $comment = $job->getItem($request->comment_id);
        if(!$comment && $comment->uId != Auth::user()->id){
            return '';
        }
        $update = $job->where('id', $comment->id)->update(['content' => htmlspecialchars($request->content)] );
        if($update){
            return htmlspecialchars($request->content);
        }
    }

    
}
