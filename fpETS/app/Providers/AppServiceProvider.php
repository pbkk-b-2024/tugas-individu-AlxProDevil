<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('manage-products', function ($user) {
            return $user->isStaff();
        });

        Gate::define('manage-suppliers', function ($user) {
            return $user->isStaff();
        });

        Gate::define('view-orders', function ($user) {
            return $user->isStaff();
        });

        Gate::define('view-user-orders', function ($user) {
            return $user->isUser();
        });

        Gate::define('manage-shipments', function ($user) {
            return $user->isStaff();
        });

        Gate::define('review', function ($user) {
            return $user->isUser();
        });

        Gate::define('manage-categories', function ($user) {
            return $user->isStaff();
        });
    }
}
