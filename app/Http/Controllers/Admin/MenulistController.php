<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\MenulistRequest;
use Session;

use App\Models\Menulist;
use App\Models\Menugroup;

class MenulistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->menu = new MenuList;
    }
    
    protected $title = 'Menu List';
    public function index(Request $request)
    {
        $group = ($request->group) ? $request->group : Menugroup::first()->id;
        if ($request->group == '') {
            return redirect( url('admin/menulists?group='.$group) );
        }
        return view('admins.menulists.index',[
            'title'         => $this->title,
            'menuLists'     => $this->menu->getLinks($group),
            'parents'       => $this->menu->getListMenuByGroup($group),
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
    public function store(MenulistRequest $request)
    {
        $this->menu->name        = strip_tags($request->name);
        $this->menu->url         = strip_tags($request->url);
        $this->menu->parent      = strip_tags($request->parent);
        $this->menu->status      = ($request->status == 1) ? 1 : 0;
        $this->menu->sort        = strip_tags($request->sort);
        $this->menu->menugroup   = strip_tags($request->menugroup);
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
        $menulist = $this->menu->getItem($id);
        if( !$menulist){
            return view('admins.errors.404');
        }
        return view('admins.menulists.edit',[
            'menuList'      => $menulist,
            'title'         => $this->title,
            'menuLists'     => $this->menu->getLinks($menulist->menugroup),
            'parents'       => $this->menu->listParentDefault($menulist->parent,$menulist->menugroup),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenulistRequest $request, $id)
    {
        $stores = $this->menu->getItem($id);
        $stores->name        = strip_tags($request->name);
        $stores->url         = strip_tags($request->url);
        $stores->parent      = strip_tags($request->parent);
        $stores->status      = ($request->status == 1) ? 1 : 0;
        $stores->sort        = strip_tags($request->sort);
        $stores->menugroup   = strip_tags($request->menugroup);
        $stores->save();
        return redirect( url('admin/menulists?group='.$request->menugroup) )->with('update_succeeded', config('admin.update_succeeded'));
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

    public function ajax_check_url(Request $request)
    {
        
        $id = strip_tags($request->id);
        $url = strip_tags($request->url);
        if($id != ''){
            $check = Menulist::where('id','<>',$id)->where('url',$url)->first();
        }else{
            $check = $this->menu->getItemByUrl($url);
        }
        if($check) {
            return Response::json(array('msg' => 'true'));
        }
        return Response::json(array('msg' => 'false'));
    }

    public function  ajax_del($id)
    {
        return $this->menu->delItem($id);
    }

    public function ajax_status($id)
    {
        return $this->menu->updateStatus($id);
    }
}
