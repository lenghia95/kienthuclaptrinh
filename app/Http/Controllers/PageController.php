<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use View;
use Auth;
use Cookie;

use App\Models\Setting;
use App\Models\Menulist;
use App\Models\Page;
use App\Models\Post;
use App\Models\Contact;


class PageController extends Controller
{
    public function __construct()
    {
        if(request()->segment(1) != 'login'){
            Cookie::queue('back_load', request()->fullUrl(), 30);
        }
        
    }

    public function index(Request $request)
    {   
        $page =  Page::getPageBySlug('chia-se');
        return view('homes.index',[
            'page'  => $page,
            'posts' => Post::getPosts(strip_tags($request->s)),
        ]);
    }

    public function about()
    {
        $about = Page::getPageBySlug('about');
        return view('homes.pages.about',[
            'about'     => $about
        ]);
    }

    public function contact()
    {
        return view('homes.pages.contact');
    }

    public function postContact(ContactRequest $request)
    {
        $store = new Contact;
        $store->name    = strip_tags($request->name);
        $store->email   = strip_tags($request->email);
        $store->phone   = strip_tags($request->phone);
        $store->content = strip_tags($request->content);
        $store->save();
        return redirect( url('contact') )->with('msg','Chúng tôi đã nhận được liên hệ từ phía bạn, chúng tôi sẽ xem xét và liên hệ với bạn trong thời gian sơm nhất!!');
    }


    public function login()
    {
        if( Auth::check() ){
            return redirect( url('/') ) ;
        }
        return view('homes.pages.login');
    }

    public function postLogin(Request $request)
    {
        $remember = ($request->remember == 'on') ? true : false;
        $back = ( $request->cookie('back_load') ) ?  $request->cookie('back_load') : $request->cookie('back');
        if (Auth::attempt( ['email' => $request->email, 'password' => $request->password], $remember )) {
            return redirect()->intended( $back );
        }else{
            return redirect( url('login') )->with('failed','Lỗi, Email hoặc mật khẩu chưa đúng!!');
        }
    }
    
    public function logout(Request $request)
    {
        $back = $request->back;
        $cookie = cookie('back', $back, 30);
        Auth::logout();
        return redirect( url('login') )->withCookie($cookie);
    }
}
