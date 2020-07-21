<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $title = 'Comment';
    public function index()
    {
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        return view('admins.comments.index',[
            'comments' => Comment::getItems(),
            'title'    => $this->title
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        $obj = new Comment;
        return view('admins.comments.show',[
            'comment'   => $obj->getItem($id),
            'title'     => $this->title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        $obj = new Comment;
        $delItem = $obj->delComments($id);
        if($delItem){
            return redirect()->route('comments.index')->with('delete_succeeded',config('admin.delete_succeeded'));
        }
        return redirect()->route('comments.index',[$id])->with('failed',config('admin.failed'));
    }

    public function ajaxStauts($id)
    {
        $obj = new Comment;
        return $obj->updateStatus($id);
    }

    public function ajaxDelComment($id)
    {
        $obj = new Comment;
        $delItem = $obj->delComments($id);
        $msg = ($delItem) ? config('admin.delete_succeeded') : config('admin.failed');
        return $msg;
    }

}
