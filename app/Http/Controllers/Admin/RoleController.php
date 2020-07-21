<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Gate;
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
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        return view('admins.roles.index',[
            'title'     => $this->title,
            'roles'     => Role::getItems()
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
    public function store(RoleRequest $request)
    {
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        $stores = new Role;
        $stores->name           = $request->name;
        $stores->display_name   = $request->display_name;
        $stores->description    = $request->description;
        $stores->save();
        return redirect()->route('roles.index')->with('save_succeeded', config('admin.save_succeeded') );
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
        return view('admins.roles.edit',[
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
    public function update(RoleRequest $request, $id)
    {
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        $update = Role::where('id',$id)->update([
            'name'                => $request->name,
            'display_name'        => $request->display_name,
            'description'         => $request->description,
        ]);
        if($update){
            return redirect()->back()->with('update_succeeded', config('admin.update_succeeded'));
        }
        return redirect()->route('roles.edit',[$id])->with('failed', config('admin.failed'));
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
        $id = strip_tags($request->id);
        $name = strip_tags($request->name);
        if($id != ''){
            $check = Role::where('id','<>',$id)->where('name',$name)->first();
        }else{
            $check = Role::where('name',$name)->first();
        }
        if($check) {
            return Response::json(array('msg' => 'true'));
        }
        return Response::json(array('msg' => 'false'));
    }

    public function  ajax_del($id)
    {
        if (! Gate::allows('full')) {
            return 'false';
        }
        $role = Role::getItem($id);
        if($role){
            $del = $role->delete();
            if($del){
                return 'true';
            }
        }
        return 'false';
    }
}
