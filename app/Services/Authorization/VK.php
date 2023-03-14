<?php

declare(strict_types=1);

namespace App\Services\Authorization;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class VK
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function redirectToProvider(): RedirectResponse
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    /**
     * @return RedirectResponse
     */
    public function handle(): RedirectResponse
    {
        $vkUserData = Socialite::driver('vkontakte')->user();

        $user = $this->userRepository->getByEmail($vkUserData->getEmail());

        if (is_null($user)) {
            $user = User::create([
                'name' => $vkUserData->getName(),
                'email' => $vkUserData->getEmail(),
                'vk_id' => $vkUserData->getId(),
                'password' => Hash::make(Str::random(10)),
            ]);

            if (! is_null($vkUserData->getAvatar())) {
                $user->addMediaFromUrl($vkUserData->getAvatar())
                    ->preservingOriginal()
                    ->toMediaCollection('profile_photo');
            }
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
