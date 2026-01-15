<?php

namespace App\Providers;

use App\Models\Borrowing;
use App\Models\User;
use App\Policies\BorrowingPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Borrowing::class => BorrowingPolicy::class,
    ];

    public function boot(): void
    {
        Gate::define('admin-only', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
