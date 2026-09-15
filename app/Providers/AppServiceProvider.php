<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\SchoolProfile;

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
        // Share cached school profile with views to avoid redundant queries to TiDB
        View::composer('*', function ($view) {
            try {
                $profile = Cache::rememberForever('school_profile', function () {
                    return SchoolProfile::first();
                });
            } catch (\Throwable $e) {
                $profile = null;
            }

            $view->with([
                'profile' => $profile,
                'appProfile' => $profile,
            ]);
        });
    }
}
