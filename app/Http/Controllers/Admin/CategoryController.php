<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\CategoryRequest;
use Session;

use App\Models\Category;
use App\Models\PostCategory;
use App\Models\Post;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->menu = new Category;
        $this->postCategory = new PostCategory;
    }
    
    protected $title = 'Categories';
    public function index()
    {
        return view('admins.categories.index',[
            'title'         => $this->title,
            'categories'    => $this->menu->getLinks(),
            'parents'       => $this->menu->getListMenuByGroup(),
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
    public function store(CategoryRequest $request)
    {
        $this->menu->name        = strip_tags($request->name);
        $this->menu->slug        = strip_tags($request->slug);
        $this->menu->parent      = strip_tags($request->parent);
        $this->menu->status      = ($request->status == 1) ? 1 : 0;
        $this->menu->sort        = strip_tags($request->sort);
        $this->menu->save();
        return redirect()->back()->with('update_succeeded',config('admin.update_succeeded'));
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
        $category = $this->menu->getItem($id);
        if( !$category ){
            return view('admins.errors.404');
        }
        return view('admins.categories.edit',[
            'category'      => $category,
            'title'         => $this->title,
            'categories'     => $this->menu->getLinks(),
            'parents'       => $this->menu->listOptionsSelected($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $stores = $this->menu->getItem($id);
        $stores->name        = $request->name;
        $stores->slug        = $request->slug;
        $stores->parent      = $request->parent;
        $stores->status      = ($request->status == 1) ? 1 : 0;
        $stores->seo_title   = $request->seo_title;
        $stores->sort        = $request->sort;
        $stores->save();
        return redirect()->back()->with('update_succeeded', config('admin.update_succeeded'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    #======================Ajax====================#
    public function ajaxCheckSlug(Request $request)
    {
        
        $id = strip_tags($request->id);
        $slug = strip_tags($request->slug);
        if($id != ''){
            $check = Category::where('id','<>',$id)->where('slug',$slug)->first();
        }else{
            $check = $this->menu->getItemByUrl($slug);
        }
        if($check) {
            return Response::json(array('msg' => 'true'));
        }
        return Response::json(array('msg' => 'false'));
    }

    public function  ajaxDel($id)
    {
        $cat = $this->menu->getItem($id);
        if($cat && $cat->parent != 0){
            $catParent = $this->menu->getItemByParent($cat->parent);
            if($catParent){
                $this->postCategory->updateByCat($id,$catParent->id);
            }
            $delItem = $cat->delete(); 
            if($delItem){
                return 'true';
            }
        }
        
        return 'false';
        
    }

    public function ajaxStatus($id)
    {
        return $this->menu->updateStatus($id);
    }
}
