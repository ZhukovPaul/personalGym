<?php

namespace App\Providers;

use App\Contracts\Repositories\Repository;
use App\Models\User;
use App\Repositories\WorkoutSectionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Repository::class, WorkoutSectionRepository::class);
        //$this->app->bind(User::class, User::class);
        /*  $this->app->bind(User::class, function ($app) {
              return Auth::user();
          });*/
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
