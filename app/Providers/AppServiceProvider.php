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
