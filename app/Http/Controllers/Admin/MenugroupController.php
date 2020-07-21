<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\MenugroupRequest;

use App\Models\Menugroup;

class MenugroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $title = 'Menu Groups';
    public function __construct()
    {
        $this->menu = new Menugroup;
    }

    public function index()
    {
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        return view('admins.menugroups.index',[
            'title'          => $this->title,
            'menuGroups'     => $this->menu->getItems()
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
    public function store(MenugroupRequest $request)
    {
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        $this->menu->name        = $request->name;
        $this->menu->key         = $request->key;
        $this->menu->description = $request->description;
        $this->menu->status      = ($request->status == 1) ? 1 : 0;
        $this->menu->save();
        return redirect()->route('menugroups.index')->with('save_succeeded',config('admin.save_succeeded'));
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
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        $menuGroup = $this->menu->getItem($id);
        if(! $menuGroup){
            return view('admins.errors.404');
        }
        return view('admins.menugroups.edit',[
            'menuGroup'     => $this->menu->getItem($id),
            'title'         => $this->title,
            'menuGroups'    => $this->menu->getItems()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenugroupRequest $request, $id)
    {   
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        $stores = $this->menu->getItem($id);
        $stores->name        = $request->name;
        $stores->key         = $request->key;
        $stores->description = $request->description;
        $stores->status      = ($request->status == 1) ? 1 : 0;
        $stores->save();
        return redirect()->route('menugroups.index')->with('update_succeeded',config('admin.update_succeeded'));
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

    public function ajax_check_key(Request $request)
    {
        $id = strip_tags($request->id);
        $key = strip_tags($request->key);
        if($id != ''){
            $check = Menugroup::where('id','<>',$id)->where('key',$key)->first();
        }else{
            $check = $this->menu->getItemByKey($key);
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
