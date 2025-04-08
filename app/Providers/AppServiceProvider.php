<?php

namespace App\Providers;

use App\Models\InformationContact;
use App\Models\Message;
use App\Models\Service;
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
        // Share users with all views
        View::share('users', User::all());

        // Share data with all views using View composer
        View::composer('*', function ($view) {
            // Share unread messages count
            $view->with('unreadMessagesCount', Message::whereNull('reply')->count());

            // Share information contact data
            $informationContact = InformationContact::first();
            $view->with('informationContact', $informationContact);

            // Share services data for WhatsApp dropdown
            $view->with('services', Service::all());
        });
    }
}
