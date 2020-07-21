<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use App\Models\Page;
use Session;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $title = 'Pages';
    public function index()
    {
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        $page = new Page;
        return view('admins.pages.index',[
            'title'     => $this->title,
            'pages'     => $page->getItems()
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
        $insert = new Page;
        $insert->title            = $request->title;
        $insert->slug             = $request->slug;
        $insert->content          = $request->content;
        $insert->seo_title        = $request->seo_title;
        $insert->seo_description  = $request->seo_description;
        $insert->seo_keywords     = $request->seo_keywords;
        $insert->save();
        return redirect()->back()->with('save_succeeded',config('admin.save_succeeded'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = new Page;
        if( ! $page->getItem($id) ){
            return view('admins.errors.404');
        }
        return view('admins.pages.show',[
            'page'   => $page->getItem($id),
            'title'    => $this->title
        ]);
    }

    public function error404()
    {
        return view('admins.errors.404');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = new Page;
        if( ! $page->getItem($id) ){
            return view('admins.errors.404');
        }
        return view('admins.pages.edit',[
            'title'     => $this->title,
            'page'      => $page->getItem($id)
        ]);
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
        $page = new Page;
        $update = $page->getItem($id);
        $update->title            = $request->title;
        $update->slug             = $request->slug;
        $update->content          = $request->content;
        $update->seo_title        = $request->seo_title;
        $update->seo_description  = $request->seo_description;
        $update->seo_keywords     = $request->seo_keywords;
        $update->save();
        return redirect()->route('pages.index')->with('update_succeeded',config('admin.update_succeeded') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = new Page;
        $del = $page->delItem($id);
        if($del){
            return redirect()->route('pages.index')->with('delete_succeeded',config('admin.delete_succeeded'));
        }
        return redirect()->back()->with('failed',config('admin.failed'));
    }

    public function ajax_del($id)
    {
        $page = new Page;
        $del = $page->delItem($id);
    }
}
