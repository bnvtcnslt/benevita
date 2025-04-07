<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\View;
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
    public function boot()
    {
        View::share('users', User::all());
        View::composer('*', function ($view) {
            $view->with('unreadMessagesCount', Message::whereNull('reply')->count());
        });
    }
}
