<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Repositories\Repository;
use App\Models\User;
use App\Repositories\WorkoutSectionRepository;
use Illuminate\Support\Facades\Auth;

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
