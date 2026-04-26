<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      Gate::define('owns-user', function (User $authenticatedUser, User $targetUser): bool {
        return (int) $authenticatedUser->user_id === (int) $targetUser->user_id;
      });

      Gate::define('access-admin', function (User $authenticatedUser): bool {
        return strtolower((string) $authenticatedUser->role) === 'admin';
      });
    }
}
