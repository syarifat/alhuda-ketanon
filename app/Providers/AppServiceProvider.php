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
        if (app()->environment('production') || str_contains(request()->getHost(), 'miproalhuda.sch.id') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Share cached school profile with views to avoid redundant queries to TiDB
        View::composer('*', function ($view) {
            static $profile = null;

            if ($profile === null) {
                try {
                    $attributes = Cache::rememberForever('school_profile_attrs', function () {
                        $item = SchoolProfile::first();
                        return $item ? $item->getAttributes() : [];
                    });
                    $profile = (new SchoolProfile())->forceFill($attributes);
                } catch (\Throwable $e) {
                    $profile = SchoolProfile::first() ?? new SchoolProfile();
                }
            }

            $view->with([
                'profile' => $profile,
                'appProfile' => $profile,
            ]);
        });
    }
}
