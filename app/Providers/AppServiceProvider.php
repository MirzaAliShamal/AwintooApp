<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Client;

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
            $user = auth()->user();
            
            if ($user) {
                $userId = $user->id;
                if ($user->role == 1) {
                    $unreadNotifications = Notification::where('read', false)->get();
                } else {
                    $clients = Client::where('user_id', $userId)->pluck('id');
                    $unreadNotifications = Notification::whereIn('client_id', $clients)
                                                        ->where('read', false)
                                                        ->get();
                }
                $unreadNotificationsCount = $unreadNotifications->count();
                $view->with([
                    'notifications' => $unreadNotifications,
                    'unreadNotificationsCount' => $unreadNotificationsCount,
                ]);
            }
        });

        view()->composer('front.partials.sidebar', function ($view) {
            $client = Client::with('restInfo')->where('id', auth('client')->id())->first();
            $view->with([
                'client' => $client,
            ]);
        });
        
        view()->composer('front.partials.navbar', function ($view) {
            $unreadNotifications = Notification::where('client_id', auth('client')->id())->where('read', false)->get();
            $unreadNotificationsCount = $unreadNotifications->count();
            $view->with([
                'unreadNotificationsCount' => $unreadNotificationsCount,
            ]);            
        });
        
        Paginator::useBootstrapFive();
    }
}
