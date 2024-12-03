<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Profile;
use Illuminate\Support\Facades\View;

class ProfileMenuProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.umum.header', function ($view) {
            $menuItems = Profile::orderBy('profile_id')
            ->where('status', 'active')
            ->get();
            $view->with('menuItems', $menuItems);
        });
    }
}
