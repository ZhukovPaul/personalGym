<?php

namespace App\Providers;

use App\Models\WorkoutSection;
use App\Policies\WorkoutSectionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        //'App\Models\WorkoutSection' => 'App\Policies\WorkoutSectionPolicy',
        WorkoutSection::class => WorkoutSectionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
