<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define(UserRole::ADMIN->value, function (User $user)
        {
            return $user->role === UserRole::ADMIN->value;
        });

        Gate::define(UserRole::MODERATOR->value, function (User $user)
        {
            return $user->role === UserRole::MODERATOR->value;
        });

        Gate::define(UserRole::USER->value, function (User $user)
        {
            return $user->role === UserRole::USER->value;
        });
    }
}
