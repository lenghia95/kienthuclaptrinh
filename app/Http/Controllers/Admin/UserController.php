<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Session;
use Auth;
use App\Helpers\articleService;

use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $title = 'Users';
    public function __construct()
    {
        $this->user = new User;
        $this->articleService = new articleService;
    }
    public function index()
    {
        return view('admins.users.index',[
            'users' => $this->user->getItems(),
            'roles' => Role::getItems(),
            'title' => $this->title,
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

    public function store(UserRequest $request)
    {   
        if (! Auth::user()->can('create')) {
            return redirect()->route('users.index')->with('failed','Sorry, You are not authorized');
        }
        $uploadFile = $this->articleService->uploadFile('avatar','uploads/users/');

        $user_id = User::create([
            'username'       => strip_tags($request->username),
            'email'          => strip_tags($request->email),
            'password'       => bcrypt($request->password),
            'fullname'       => strip_tags($request->fullname),
            'remember_token' => strip_tags($request->_token),
            'status'         => ($request->status == 1) ? 1 : 0,
            'avatar'         => $uploadFile
        ])->id;
        
        if($user_id){
            RoleUser::updateOrInsert($request->roles, $user_id);
            return redirect()->back()->with('save_succeeded',config('admin.save_succeeded'));
        }
        return redirect()->back()->with('failed',config('admin.failed'));

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->getItem($id);
        if( ! $user ){
            return view('admins.errors.404');
        }
        if (Auth::id() !== $user->id && Auth::user()->permission !== 'Supper_admin') {
            return redirect()->route('users.index')->with('failed','Sorry, You are not authorized');
        }
        return view('admins.users.show',[
            'user' => $user,
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
        
        $user = $this->user->getItem($id);
        
        if( ! $user ){
            return view('admins.errors.404');
        }
        if (Auth::id() !== $user->id && Auth::user()->permission !== 'Supper_admin') {
            return redirect()->route('users.index')->with('failed','Sorry, You are not authorized');
        }
        return view('admins.users.edit',[
            'user' => $user,
            //'listRoles' => Role::getListOptionRole($user->role_id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {   
        $update = $this->user->getItem($id);

        if (Auth::id() !== $update->id && Auth::user()->permission !== 'Supper_admin') {
            return redirect()->route('users.index')->with('failed','Sorry, You are not authorized');
        }

        if($update){
            $uploadFile = $this->articleService->uploadFile('avatar','uploads/users/');

            if($uploadFile != ""){
                $this->articleService->delFile($update->avatar);
            }

            $update->fullname    = strip_tags($request->fullname);
            $update->address     = strip_tags($request->address);
            $update->phone       = strip_tags($request->phone);
            $update->avatar      = ($uploadFile == '') ? $update->avatar : $uploadFile;
            $update->save();
            return redirect()->route('users.index')->with('update_succeeded',config('admin.update_succeeded') );
        }
        return redirect()->route('users.index')->with('failed',config('admin.failed') );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Auth::user()->can('create')) {
            return redirect()->route('users.index')->with('failed','Sorry, You are not authorized');
        }
        $user = $this->user->getItem($id);
        if( !$user ){
            return redirect()->route('users.index')->with('failed',config('admin.failed'));
        }
        if( $user->permission == 'Supper_admin' ){
            return redirect()->route('users.index')->with('failed', 'Sorry, You cannot delete Supper Admin!');
        }
        $del = $user->delete();
        if($del){
            $this->articleService->delFile($user->avatar);
            return redirect()->route('users.index')->with('delete_succeeded',config('admin.delete_succeeded'));
        }
    }

    public function  ajaxDel($id)
    {
        $user = $this->user->getItem($id);
        if($user){
            $del = $user->delete();
            if($del){
                $this->articleService->delFile($user->avatar);
                return 'true';
            }
        }
        return 'false';

    }

    public function ajaxUniqueEmail(Request $request)
    {
        $id = strip_tags($request->id);
        $email = strip_tags($request->email);
        if($id != ''){
            $check = User::where('id','<>',$id)->where('email',$email)->first();
        }else{
            $check = $this->user->getItemByEmail($email);
        }
        if($check) {
            return Response::json(array('msg' => 'true'));
        }
        return Response::json(array('msg' => 'false'));
    }

    public function ajaxStauts($id)
    {
        $obj = new User;
        return $obj->updateStatus($id);
    }

}
