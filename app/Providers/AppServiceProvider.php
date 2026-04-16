<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CompanySetting; // Assurez-vous que le modèle existe dans app/Models/


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
        // Partage la variable $settings avec toutes les vues du site (*)
        View::composer('*', function ($view) {
            $settings = CompanySetting::first();
            $view->with('settings', $settings);
        });
    }
}