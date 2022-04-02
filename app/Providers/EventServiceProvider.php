<?php

namespace App\Providers;

use \App\Listeners\WorkoutAddSubscriber;
use \App\Listeners\UserLoginLogoutSubscriber;
use \SocialiteProviders\VKontakte\VKontakteExtendSocialite;
use \SocialiteProviders\Manager\SocialiteWasCalled;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */

    protected $subscribe = [
       
    ]; 


    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SocialiteWasCalled::class => [
            VKontakteExtendSocialite::class.'@handle',
        ],
      /*  WorkoutAdding::class =>[
            WorkoutAddListener::class
        ]*/
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function shouldDiscoverEvents()
    {
        return true;
    }
}
