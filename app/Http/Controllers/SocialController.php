<?php
 
namespace App\Http\Controllers;
use Auth;
use App\User;
use Socialite;
use Cookie;

class SocialController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
 
    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
 
        $authUser = $this->findOrCreateUser($user);
        
        // Chỗ này để check xem nó có chạy hay không
        // dd($user);
 
        Auth::login($authUser, true);
        $back = ( request()->cookie('back_load') ) ?  request()->cookie('back_load') : request()->cookie('back');
        return redirect()->intended( $back );
    }
 
    private function findOrCreateUser($facebookUser){
        return  User::updateOrCreate(
            ['provider_id' => $facebookUser->id],
            [
                'username' => $facebookUser->name,
                'password' => $facebookUser->token,
                'email' => $facebookUser->email,
                'provider_id' => $facebookUser->id,
                'provider' => $facebookUser->id,
                'status' => 1,
            ]
        );
        
    }
}