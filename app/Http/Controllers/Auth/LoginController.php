<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\File as Files;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Models\UserGroup;
use App\Providers\RouteServiceProvider;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{Hash,Auth,Storage};
use Illuminate\Support\Facades\DB;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        //echo env("APP_URL")."/".env('VKONTAKTE_REDIRECT_URI') ;
        return Socialite::driver('vkontakte')->redirect();
    }

    public function handleProviderCallback()
    {
        $VKUser = Socialite::driver('vkontakte')->user();
    
        if(! $createUser = \App\Models\User::firstWhere ('vk_id',$VKUser->getId() )){
            $createUser = new \App\Models\User();
            $createUser->name = $VKUser->getNickname();
            $createUser->email = $VKUser->getEmail();
            $createUser->vk_id = $VKUser->getId();
            
            $createUser->password = Hash::make(Str::random(10)) ;
            

            if($VKUser->getAvatar()){
                $path = $VKUser->getAvatar();
                preg_match('/([a-zA-Z0-9_-]*).jpg/', $path, $matches, PREG_OFFSET_CAPTURE);
                $filename = $matches[0][0];
                $filename = "/users/".$matches[0][0];
                
                $file = file_get_contents($path);
                Storage::put("/users/".$matches[0][0], $file,);
                
                $image = new \App\Models\UserImage();
                $image->path  = $filename;
                $image->save();
                
                $createUser->user_image_id = $image->id;
            }
            $createUser->save();    

            DB::table("users_groups")->insert(["user_id"=>$createUser["id"],"user_group_id"=>2]);
        
            $createUser->markEmailAsVerified();
        }
        Auth::login($createUser);
        return redirect($this->redirectTo);
        
    }
}
