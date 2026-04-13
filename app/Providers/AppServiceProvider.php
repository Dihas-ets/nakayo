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
    public function boot(): void
    {
        // On partage la variable $settings avec TOUTES les vues du site
        View::composer('*', function ($view) {
            // On récupère les réglages (la première ligne de la table)
            // Si la table est vide, on crée un objet vide pour éviter les erreurs
            $settings = CompanySetting::first() ?? new CompanySetting();

            // On envoie la variable à la vue
            $view->with('settings', $settings);
        });
    }
}