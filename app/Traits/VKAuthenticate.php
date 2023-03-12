<?php

namespace App\Traits;

use App\Models\User;
use App\Models\UserImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

trait VKAuthenticate
{
    public function redirectToVkProvider()
    {
        //echo env("APP_URL")."/".env('VKONTAKTE_REDIRECT_URI') ;
        return Socialite::driver('vkontakte')->redirect();
    }

    public function handleVkProviderCallback()
    {
        $VKUser = Socialite::driver('vkontakte')->user();

        if (! $createUser = User::firstWhere('vk_id', $VKUser->getId())) {
            $createUser = new User();
            $createUser->name = $VKUser->getNickname();
            $createUser->email = $VKUser->getEmail();
            $createUser->vk_id = $VKUser->getId();

            $createUser->password = Hash::make(Str::random(10));

            if ($VKUser->getAvatar()) {
                $path = $VKUser->getAvatar();
                preg_match('/([a-zA-Z0-9_-]*).jpg/', $path, $matches, PREG_OFFSET_CAPTURE);
                $filename = $matches[0][0];
                $filename = '/users/' . $matches[0][0];

                $file = file_get_contents($path);
                Storage::put('/users/' . $matches[0][0], $file);

                $image = new UserImage();
                $image->path = $filename;
                $image->save();

                $createUser->user_image_id = $image->id;
            }

            $createUser->save();

            DB::table('users_groups')->insert(['user_id'=>$createUser['id'], 'user_group_id'=>2]);

            $createUser->markEmailAsVerified();
        }

        Auth::login($createUser);

        return redirect($this->redirectTo);
    }
}
