<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Auth;

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
        $general = gs();
        
        $viewShare['general'] = $general;
        view()->share($viewShare);

        view()->composer('admin.partials.navbar', function ($view) {
            $unreadNotifications = Notification::where('read', false)->get();
            $unreadNotificationsCount = $unreadNotifications->count();
            $view->with([
                'notifications' => $unreadNotifications,
                'unreadNotificationsCount' => $unreadNotificationsCount,
            ]);
        });
        
        Paginator::useBootstrapFive();
    }
}
