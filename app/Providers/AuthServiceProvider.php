<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* define a admin user role */
        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });

        /* define a manager user role */
        Gate::define('isManager', function($user) {
            return $user->role == 'manager';
        });

        /* define a user role */
        Gate::define('isUser', function($user) {
            return $user->role == 'user';
        });

        Gate::define('view-dashboard', function ($user) {
            return $user->isAdmin();
        });
    }
}
