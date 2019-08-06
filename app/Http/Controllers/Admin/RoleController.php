<?php

namespace App\Modules\Backend\Controllers;

use App\Http\Requests\ReRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Session;

use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $title = 'Roles';
    public function index()
    {
        return view('admin.roles.index',[
            'title'     => $this->title,
            'roles'     => Role::get()
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
    public function store(ReRole $request)
    {
        $stores = new Role;
        $stores->name        = $request->name;
        $stores->slug        = $request->slug;
        $stores->description = $request->description;
        $stores->save();
        return back()->with('update_succeeded','');
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
        return view('admin.roles.edit',[
            'role'  => Role::find($id),
            'title' => $this->title,
            'roles' => Role::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReRole $request, $id)
    {
        $update = Role::where('id',$id)->update([
            'name'        => $request->name,
            'slug'        => $request->slug,
            'description' => $request->description,
        ]);
        if($update){
            return redirect(config('modules.backend.prefix_url')."/role")->with('update_succeeded','');
        }
        return redirect(config('modules.backend.prefix_url')."/role")->with('update_failed','');
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

    public function ajax_check_name(Request $request)
    {
        if($request->ajax()) {
            $name = Role::where('name', $request->name)->get();
            if($name->count()) {
                return Response::json(array('msg' => 'true'));
            }
            return Response::json(array('msg' => 'false'));
        }
    }

    public function  ajax_del($id)
    {
        Role::where('id',$id)->delete();
    }
}
