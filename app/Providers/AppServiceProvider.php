<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CompanySetting;
use App\Models\Service;

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
        // Partage les variables avec toutes les vues du site (*)
        View::composer('*', function ($view) {
            // 1. Paramètres du site
            $settings = CompanySetting::first();
            
            
            // 2. Services pour le footer (on en prend 6 max pour l'esthétique)
            // On utilise $footerServices pour ne pas créer de conflit avec une variable $services en page d'accueil
            $footerServices = Service::where('status', 'publié')->limit(6)->get();

            $view->with([
                'settings' => $settings,
                'footerServices' => $footerServices
            ]);
        });
    }
}