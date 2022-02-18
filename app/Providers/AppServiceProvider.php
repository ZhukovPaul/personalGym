<?php

namespace App\Providers;

use \Illuminate\Support\Facades\{View as ViewFacade ,Auth};
use Facade\FlareClient\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 
        ViewFacade::share("user", Auth::user());
    }
}
