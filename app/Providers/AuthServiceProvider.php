<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
// isAuthorized() is a method we added to the User model. It returns true if the user's role is admin or editor.

        Gate::define('isAdmin', function($user){
            return $user->role === 'admin';
        });

        Gate::define('isEditor', function($user){
            return $user->role === 'editor';
        });

        Gate::define('isUser', function($user){
            return $user->role === 'user';
        });

        Gate::resource('chirp', 'App\Policies\ChirpPolicy');
    }
}
