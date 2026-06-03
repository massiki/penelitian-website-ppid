<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        // view()->composer ('*', function($view) {
        //     $menus = Menu::with('child')->get();
        //     $view->with('menus',$menus);
        // });

        // view()->composer ('*', function($view) {
        //     $menus = Cache::remember('menus', 60, function() {
        //         return Menu::with('child')->get();
        //     });

        //     $view->with('menus', $menus);
        // });
    }
}
