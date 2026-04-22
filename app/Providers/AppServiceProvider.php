<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Throwable;


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
        // Tambahkan ini di paling atas untuk memaksa HTTPS di Vercel
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        try {
            if (Schema::hasTable('site_settings')) {
                $settings = SiteSetting::query()->pluck('value', 'key')->toArray();
                View::share('siteSettings', $settings);
                return;
            }
            View::share('siteSettings', []);
        } catch (Throwable $e) {
            View::share('siteSettings', []);
        }
    }
}
