<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Produit;
use App\Models\User;
use App\Models\Service;
use App\Models\Formation;
use App\Models\Avis;
use App\Models\Category;
use App\Models\Tag;

class DashboardController extends Controller
{
    public function admin()
    {
        // On récupère les statistiques réelles
        $stats = [
            'articles'    => Article::count(),
            'produits'    => Produit::count(),
            'clients'     => User::where('role', 'abonné')->count(),
            'services'    => Service::count(),
            'formations'  => Formation::count(), // Table formations
            'recrutements' => \App\Models\Recrutement::count(),
            'avis'        => Avis::count(),
            'categories'  => Category::count(),
            'tags'        => Tag::count(),
        ];

        return view('dashboards.admin', compact('stats'));
    }

    public function abonner()
    {
        return view('dashboards.abonner');
    }
}