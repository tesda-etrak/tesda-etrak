<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
        Blade::if('superadmin', function () {
            return Auth::check() && Auth::user()->role === 'superadmin';
        });

        Blade::if('admin', function () {
            return Auth::check() && Auth::user()->role === 'admin';
        });

        Blade::if('alladmin', function () {
            return Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin');
        });

        Blade::if('user', function () {
            return Auth::check() && Auth::user()->role === 'user';
        });
    }
}
