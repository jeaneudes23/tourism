<?php

namespace App\Providers;

use Filament\Notifications\Livewire\DatabaseNotifications;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        DatabaseNotifications::trigger('components.notifications-trigger');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        FilamentColor::register([
          'primary' => '#659bad'
        ]);
    }
}
