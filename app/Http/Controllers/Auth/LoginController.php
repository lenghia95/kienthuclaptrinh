<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Auth;
use DB;
use Response;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        if(Auth::check()){
            return redirect()->to('admin');
        }
        return view('admins.auth.login');
    }

    public function postLogin(Request $request)
    {
        $remember = ($request->remember == 'on') ? true : false;
        if (Auth::attempt( ['email' => $request->email, 'password' => $request->password], $remember )) {
            return redirect()->intended( $request->cookie('back') )->with('login_successful',config('admin.login_successful'));
        }else{
            return redirect()->route('login')->with('failed','Sory, Incorrect email or password!!');
        }
        
    }

    public function logout(Request $request)
    {
        $back = ($request->back == '') ? url('') : $request->back;
        $cookie = cookie('back', $back, 30);
        Auth::logout();
        return redirect()->route('login')->withCookie($cookie);
    }


    public function ajaxUniqueEmail(Request $request)
    {
        $check = User::where('email',$request->email)->first();
        if($check) {
            return Response::json(array('msg' => 'true'));
        }
        return Response::json(array('msg' => 'false'));
    }

    public function postRegister(UserRequest $request)
    {
        $stores = new User;
        $stores->username       = strip_tags($request->username);
        $stores->email          = strip_tags($request->email);
        $stores->password       = bcrypt($request->password);
        $stores->remember_token = strip_tags($request->_token);
        $stores->save();
        return redirect()->back()->with('msg','Bạn đã đăng ký tài khoản thành công, Vui lòng đợi Admin duyệt, xin cảm ơn!!');
    }
}
