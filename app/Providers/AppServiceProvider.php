<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\BackgroundImage;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;

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
        view()->composer('*', function ($view) {
            $menus = Cache::remember('menus', 60, function () {
                return Menu::with('child')->get();
            });
            $logo = Cache::remember('logo', 60, function () {
                return BackgroundImage::where('slug', 'logo')->latest()->first();
            });

            $view->with('menus', $menus);
            $view->with('logo', $logo);
        });
    }
}
