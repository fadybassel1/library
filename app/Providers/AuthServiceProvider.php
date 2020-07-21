<?php

namespace App\Providers;

use App\Book;
use App\Policies\BookPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
  
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('take-attendace', function ($user) {
            return $user->role=='moderator';
        });

        Gate::define('edit-delete-book', function ($user) {
            return $user->role=='superadmin' || $user->role =='admin';
        });

        Gate::define('edit-delete-reader', function ($user) {
            return $user->role=='superadmin' || $user->role =='admin';
        });

        Gate::define('edit-delete-tag', function ($user) {
            return $user->role=='superadmin' || $user->role =='admin';
        });
        Gate::define('view-problems', function ($user) {
            return $user->role=='superadmin' || $user->role =='admin';
        });
        Gate::define('view-delete-report', function ($user) {
            return $user->role=='superadmin' || $user->role =='admin';
        });
        Gate::define('view-restore-recycle', function ($user) {
            return $user->role=='superadmin' || $user->role =='admin';
        });
    }
}
