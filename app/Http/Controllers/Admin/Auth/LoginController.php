<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
//use http\Env\Request;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
            return redirect()->route('admin.login')->with('failed','Sory, Incorrect email or password!!');
        }
    }

    public function logout(Request $request)
    {
        $back = ($request->back == '') ? url('') : $request->back;
        $cookie = cookie('back', $back, 30);
        Auth::logout();
        return redirect()->route('admin.login')->withCookie($cookie);
    }
}
