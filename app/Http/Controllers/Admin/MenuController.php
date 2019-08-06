<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\MenuRequest;

use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $title = 'Menus';
    public function index()
    {
        return view('admins.menus.index',[
            'title' => $this->title
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
    public function store(MenuRequest $request)
    {
        $stores = new Menu;
        $stores->title      = strip_tags($request->title);
        $stores->icon       = strip_tags($request->icon);
        $stores->url        = strip_tags($request->url);
        $stores->order      = strip_tags($request->order);
        $stores->parent_id  = strip_tags($request->parent_id);
        $stores->save();
        return redirect()->route('menus.index')->with('save_succeeded', config('admin.save_succeeded'));

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
        $updates = Menu::getMenu($id);
        if( !$updates ){
            return redirect()->route('menus.index')->with('failed', config('admin.failed'));
        }
        $updates->title      = strip_tags($request->title);
        $updates->icon       = strip_tags($request->icon);
        $updates->url        = strip_tags($request->url);
        $updates->order      = strip_tags($request->order);
        $updates->parent_id  = strip_tags($request->parent_id);
        $updates->save();
        return redirect()->route('menus.index')->with('update_succeeded', config('admin.update_succeeded'));
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

    public function ajax_del($id)
    {
        $menu = Menu::getMenu($id);
        if(!$menu){
            return 'false';
        }
        $menu->delete();
        return 'true';
    }

    public function ajax_edit($id)
    {
        return view('admins.menus.edit',[
            'menu'  => Menu::getMenu($id),
            'listOptionsSelected'  => Menu::listOptionsSelected($id)
        ]);
    }
    
}
