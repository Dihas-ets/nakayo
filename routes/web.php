<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\RecrutementController;
use App\Http\Controllers\Admin\FormationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\GallerieController;
use App\Http\Controllers\Admin\CompanySettingController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\ProjetController;
use App\Models\Service;
use App\Models\CompanySetting;
use App\Models\Article;
use App\Models\Membre;
use App\Models\Marque;
use App\Models\Partenaire;
use App\Http\Controllers\Admin\PartenaireController; 
use App\Http\Controllers\Admin\MarqueController;
use App\Http\Controllers\Admin\MessageController;
use App\Models\Message;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InvestisseurController;
use Illuminate\Http\Request;
use App\Models\Commentaire;




/*
|--------------------------------------------------------------------------
| 1. ROUTES PUBLIQUES
|--------------------------------------------------------------------------
*/

// Route d'accueil
Route::get('/', function () {
    // A. Récupérer les catégories disponibles
    $categories = DB::table('categories')->where('status', 1)->get();

    // B. Récupérer l'article en vedette
    $featuredArticle = DB::table('articles')
        ->join('categories', 'articles.id_categorie', '=', 'categories.id_categorie')
        ->select('articles.*', 'categories.nom as category_name')
        ->where('featured', 1)->first();

    // C. Récupérer les articles récents
    $recentArticles = DB::table('articles')
        ->join('categories', 'articles.id_categorie', '=', 'categories.id_categorie')
        ->select('articles.*', 'categories.nom as category_name')
        ->where('featured', 0)->orderBy('articles.created_at', 'desc')->limit(3)->get();

    return view('welcome', compact('categories', 'featuredArticle', 'recentArticles'));
})->name('home');

// Autres pages publiques

Route::get('/about', function () {
    $team = DB::table('equipe')
                ->where('statut', 1)
                ->orderBy('ordre', 'asc')
                ->get();

     $partenaires = Partenaire::all();    
     $settings = CompanySetting::first();        

    return view('pages.about', compact('team', 'partenaires', 'settings'));
})->name('about');

    



// Page de contact (Affichage)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Envoi du formulaire (Traitement)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Route pour la page principale d'investissement
Route::get('/investisseurs', [InvestisseurController::class, 'investisseurs'])
    ->name('pages.investisseurs');



Route::get('/recrutement', function () {
    $offres = DB::table('recrutements')
                ->whereDate('date_limite', '>=', now()) // Utilise whereDate pour ignorer l'heure
                ->where('status', 'publié')
                ->orderBy('created_at', 'desc')
                ->get();

    return view('pages.recrutement', compact('offres'));
})->name('recrutement');


// Route pour voir le détail d'une offre
Route::get('/recrutement/{id}', function ($id) {
    $offre = DB::table('recrutements')
                ->where('id_recrutement', $id)
                ->first();

    if (!$offre) abort(404);

    return view('pages.recrutement_detail', compact('offre'));
})->name('recrutement.show');




// Route pour afficher toutes les formations
Route::get('/nos-formations', function () {
    $formations = DB::table('formations')
        ->where('status', 'disponible')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('pages.formations', compact('formations'));
})->name('formations');

// Route pour le détail : on utilise l'ID maintenant
Route::get('/formation/{id}', function ($id) {
    // Note : Vérifie bien si ta colonne s'appelle 'id' ou 'id_formation'
    $formation = DB::table('formations')
        ->where('id_formation', $id) 
        ->first();

    if (!$formation) abort(404);

    return view('pages.formations_show', compact('formation'));
})->name('pages.formations_show');


// page blog
/*
|--------------------------------------------------------------------------
| BLOG ROUTES (Logique + Routes ensemble)
|--------------------------------------------------------------------------
*/

// 1. PAGE INDEX (Liste des articles)
Route::get('/blog', function () {
    // 1. L'article le plus récent qui est coché "Featured" (Celui en haut à gauche)
    $featuredArticle = Article::where('status', 'publié')
                    ->join('categories', 'articles.id_categorie', '=', 'categories.id_categorie')
                        ->select('articles.*', 'categories.nom as category_name')
                        ->where('featured', 1)
                        ->latest()
                        ->first();

    // 2. Les 5 articles suivants (qu'ils soient featured ou non, mais les plus récents)
    
    $trendingArticles = Article::where('status', 'publié')
                        ->when($featuredArticle, function($query) use ($featuredArticle) {
                            return $query->where('id_article', '!=', $featuredArticle->id_article);
                        })
                        ->join('categories', 'articles.id_categorie', '=', 'categories.id_categorie')
                        ->select('articles.*', 'categories.nom as category_name')
                        ->latest()
                        ->take(5)
                        ->get();

    // 3. Tous les autres articles (les plus anciens)
    
    $excludeIds = $trendingArticles->pluck('id_article')->toArray();
    if ($featuredArticle) {
        $excludeIds[] = $featuredArticle->id_article;
    }

    $otherArticles = Article::where('status', 'publié')
                        ->whereNotIn('id_article', $excludeIds)
                        ->latest()
                        ->get();

    return view('blog.index', compact('featuredArticle', 'trendingArticles', 'otherArticles'));
})->name('blog.index');


// 2. PAGE SHOW (Détail d'un article + Compteur de vues)
Route::get('/blog/{slug}', function ($slug) {
    // On récupère l'article
    $article = Article::where('slug', $slug)->firstOrFail();
    $article = Article::with('user')->where('slug', $slug)->firstOrFail();

    // Système de comptage de vues avec Session pour éviter les abus
    $sessionKey = 'viewed_article_' . $article->id_article;
    if (!session()->has($sessionKey)) {
        // On s'assure que 'vue' n'est pas NULL avant d'incrémenter
        if (is_null($article->vue)) {
            $article->vue = 0;
        }
        $article->increment('vue');
        session()->put($sessionKey, true);
    }

    // Récupérer les articles récents
    $recentArticles = Article::where('id_article', '!=', $article->id_article)
        ->where('status', 'publié')
        ->latest()
        ->take(5)
        ->get();

    return view('blog.show', compact('article', 'recentArticles'));
})->name('blog.show');


// 3. ENREGISTRER UN COMMENTAIRE
Route::post('/blog/{id}/comment', function ($id) {
    request()->validate([
        'nom_auteur' => 'required|string|max:255',
        'email_auteur' => 'required|email|max:255',
        'contenu' => 'required|string|min:5',
    ]);

    Commentaire::create([
        'id_article' => $id,
        'nom_auteur' => request('nom_auteur'),
        'email_auteur' => request('email_auteur'),
        'contenu' => request('contenu'),
        'statut' => 'approuvé',
    ]);

    return back()->with('success', 'Merci ! Votre commentaire a été publié.');
})->name('blog.comment.store');


// 4. GÉRER LES LIKES
Route::post('/blog/{id}/like', function ($id) {
    $sessionKey = 'liked_article_' . $id;

    // 1. Vérifier si l'utilisateur a déjà liké dans cette session
    if (session()->has($sessionKey)) {
        return back()->with('info', 'Vous avez déjà aimé cet article !');
    }

    // 2. Trouver l'article
    $article = Article::where('id_article', $id)->firstOrFail();

    // 3. Incrémenter
    $article->increment('likes');

    // 4. Enregistrer en session pour bloquer le prochain essai
    session()->put($sessionKey, true);

    return back()->with('success', 'Merci pour votre mention J\'aime !');
})->name('blog.like');




// page proje
Route::get('/projets', function () {
    $projets = DB::table('projets')
        ->join('services', 'projets.id_service', '=', 'services.id_service')
        ->select(
            'projets.*', 
            'services.titre as service_nom'
        )
        ->where('projets.status', 'publié')
        ->orderBy('projets.date_realisation', 'desc')
        ->get();

    // On transforme le nom du service en "slug" pour que les filtres (ex: "Construction") 
    // correspondent aux catégories (ex: "construction")
    foreach ($projets as $p) {
        $p->cat_slug = Str::slug($p->service_nom); 
    }

    return view('realisations.projets', compact('projets'));
})->name('projets');


// Route pour voir le détail d'un projet
Route::get('/projets/{id}', function ($id) {
    $projet = DB::table('projets')
        ->join('services', 'projets.id_service', '=', 'services.id_service')
        ->select('projets.*', 'services.titre as service_nom')
        ->where('id_projet', $id)
        ->first();

    if (!$projet) abort(404);

    return view('realisations.projet_detail', compact('projet'));
})->name('projets.show');




/*
|--------------------------------------------------------------------------
| 1. ROUTE ACCUEIL (Slider Dynamique + Blog)
|--------------------------------------------------------------------------
*/




// =========================================================
// GESTION DES SERVICES (LOGIQUE INTÉGRÉE DANS LA ROUTE)
// =========================================================

// 1. Page de liste : Affiche TOUS les services

// PAGE DE LISTE DE TOUS LES SERVICES
Route::get('/services/index', function () {
    // On récupère uniquement les services dont le statut est 'publié'
    $services = Service::where('status', 'publié')
                       ->orderBy('created_at', 'desc')
                       ->get();
                       
    // On retourne la vue (assure-toi que le fichier existe dans resources/views/pages/services.blade.php)
    return view('services.index', compact('services'));
})->name('services.index');



// Route d'accueil pour le slider et les blogs
Route::get('/', function () {
    // A. Récupérer les services pour le slider
    $services = Service::where('status', 'publié')->get();

    // B. Récupérer les paramètres de l'entreprise
    $settings = CompanySetting::first();

    // C. Récupérer les catégories
    $categories = DB::table('categories')->where('status', 1)->get();
    
    // D. Logique pour l'article en vedette
    $featuredArticle = DB::table('articles')
        ->join('categories', 'articles.id_categorie', '=', 'categories.id_categorie')
        ->select('articles.*', 'categories.nom as category_name')
        ->where('featured', 1)->first();

    // E. Récupérer les articles récents
    $recentArticles = DB::table('articles')
        ->join('categories', 'articles.id_categorie', '=', 'categories.id_categorie')
        ->select('articles.*', 'categories.nom as category_name')
        ->where('featured', 0)
        ->orderBy('articles.created_at', 'desc')
        ->limit(3)->get();

    // F. Récupérer les projets publiés
    $projets = DB::table('projets')
        ->join('services', 'projets.id_service', '=', 'services.id_service')
        ->select('projets.*', 'services.titre as service_nom')
        ->where('projets.status', 'publié')
        ->orderBy('projets.date_realisation', 'desc')
        ->limit(4)
        ->get();

    $team = \App\Models\Membre::where('statut', 1)
                  ->orderBy('ordre', 'asc')
                  ->get();   
                  
    $marques = Marque::with('service')->get(); 

    $services = Service::where('status', 'publié')->get();
    
    
     $partenaires = Partenaire::orderBy('created_at', 'desc')->get();

    // Passer toutes les variables à la vue
    return view('welcome', compact(
        'team',
        'services', 
        'categories', 
        'featuredArticle', 
        'recentArticles', 
        'settings', 
        'projets',
        'marques',
        'partenaires'

    ));
})->name('home');

/*
|--------------------------------------------------------------------------
| 2. ROUTES SERVICES
|--------------------------------------------------------------------------
*/

// Détail d'un service
Route::get('/services/{id_service}', function ($id) {
    $service = Service::where('id_service', $id)
                      ->with([
                          'produits' => function($q) {
                              $q->where('statut', 'disponible');
                          },
                          'galleries'
                      ])
                      ->firstOrFail();

    $settings = CompanySetting::first();

    return view('services.show', [
        'service'  => $service,
        'settings' => $settings,
    ]);
})->name('services.show');

// Catalogue complet pour un service
Route::get('/services/{id}/produits', function ($id) {
    $service = Service::where('id', $id)
        ->with(['produits' => fn($q) => $q->where('statut', 'disponible')])
        ->firstOrFail();

    return view('services.products', compact('service'));
})->name('services.products');

// Catalogue complet par slug
Route::get('/services/{slug}/catalogue', function ($slug) {
    $mapping = [
        'construction-piscine' => 'Construction Piscine',
        'immobilier'           => 'NAKAYO Immobilier',
        'papeterie'            => 'Papeterie',
        'savonnerie'           => 'Savonnerie',
        'agro-industrie'       => 'Agro industrie et élevage' 
    ];

    if (!isset($mapping[$slug])) abort(404); // Vérifier si le slug existe

    $service = Service::where('titre', 'like', '%' . $mapping[$slug] . '%')
                      ->with(['produits' => function($q) {
                          $q->where('statut', 'disponible');
                      }])
                      ->firstOrFail();

    $settings = CompanySetting::first();

    return view('services.products', [
        'service' => $service,
        'slug'    => $slug,
        'settings' => $settings 
    ]);
})->name('services.products');

// Blog routes




// Réalisations routes


Route::get('/nos-projets', function () {
    // On récupère les projets pour les afficher
    $projets = \App\Models\Projet::where('status', 'publié')
                ->orderBy('date_realisation', 'desc')
                ->get();

    // On retourne votre vue : resources/views/realisations/projets.blade.php
    return view('realisations.projets', compact('projets'));
})->name('realisations.projets');
/*
|--------------------------------------------------------------------------
| 2. AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/inscription', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 3. ESPACE ADMINISTRATION (Protégé)
|--------------------------------------------------------------------------
*/

// Middleware pour les routes de l'administration
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // --- ACCÈS COMMUN : ADMIN & RÉDACTEUR ---
    Route::middleware(['role:admin,rédacteur'])->group(function () {
        // Tableau de bord
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

        // Profil
        Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profil/info', [ProfileController::class, 'updateInfo'])->name('profile.info');
        Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        // Blog
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('/articles', [BlogController::class, 'articles'])->name('articles');
            Route::get('/articles/creer', [BlogController::class, 'create'])->name('create');
            Route::post('/articles/stocker', [BlogController::class, 'store'])->name('store');
            Route::get('/articles/{id}/voir', [BlogController::class, 'show'])->name('show');
            Route::get('/articles/{id}/modifier', [BlogController::class, 'edit'])->name('edit');
            Route::put('/articles/{id}/maj', [BlogController::class, 'update'])->name('update');
            Route::delete('/articles/{id}/supprimer', [BlogController::class, 'destroy'])->name('destroy');
            Route::post('/upload-image', [BlogController::class, 'uploadImage'])->name('upload');

            // Liste des catégories
            Route::get('/categories', [BlogController::class, 'categories'])->name('categories');
            Route::post('/categories/store', [BlogController::class, 'storeCategory'])->name('categories.store');
            Route::put('/categories/{id_categorie}', [BlogController::class, 'updateCategory'])->name('categories.update');
            Route::delete('/categories/{id_categorie}', [BlogController::class, 'destroyCategory'])->name('categories.destroy');

            
        });
    });

    // --- ACCÈS RÉSERVÉ : SEUL L'ADMIN ---
    Route::middleware(['role:admin'])->group(function () {
        
        // Utilisateurs
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/administrateurs', [UserController::class, 'admins'])->name('admins');
            Route::get('/redacteurs', [UserController::class, 'redacteurs'])->name('redacteurs');
            Route::get('/abonnes', [UserController::class, 'abonnes'])->name('abonnes');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        });

        // Services & Produits
        Route::resource('services', ServiceController::class);
        Route::get('/categories-services', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories-services', [CategoryController::class, 'store'])->name('categories.store');
        Route::delete('/categories-services/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Gestion des Produits
        Route::get('/produits', [ProductController::class, 'index'])->name('produits.index');
        Route::get('/produits/creer', [ProductController::class, 'create'])->name('produits.create');
        Route::post('/produits', [ProductController::class, 'store'])->name('produits.store');
        Route::get('/produits/{id}', [ProductController::class, 'show'])->name('produits.show');
        Route::get('/produits/{id}/modifier', [ProductController::class, 'edit'])->name('produits.edit');
        Route::put('/produits/{id}', [ProductController::class, 'update'])->name('produits.update');
        Route::delete('/produits/{id}', [ProductController::class, 'destroy'])->name('produits.destroy');

        // Galerie
        Route::get('/galleries', [GallerieController::class, 'index'])->name('galleries.index');
        Route::post('/galleries', [GallerieController::class, 'store'])->name('galleries.store');
        Route::delete('/galleries/{id}', [GallerieController::class, 'destroy'])->name('galleries.destroy');

        // Recrutements & Formations
        Route::resource('recrutements', RecrutementController::class)->names('recrutements');
        Route::resource('formations', FormationController::class)->names('formations');



        Route::resource('partenaires', PartenaireController::class)->names('partenaires');
        Route::resource('messages', MessageController::class)->names('messages');



        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/{id}/read', [MessageController::class, 'markAsRead']);
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
        


        Route::resource('marques', MarqueController::class)->names('marques');
        // Équipe

    Route::get('/team', [TeamController::class, 'index'])->name('team.index');
    Route::get('/team/create', [TeamController::class, 'create'])->name('team.create');
    Route::post('/team', [TeamController::class, 'store'])->name('team.store');
    Route::get('/team/{id}/edit', [TeamController::class, 'edit'])->name('team.edit');
    Route::put('/team/{id}', [TeamController::class, 'update'])->name('team.update');
    Route::delete('/team/{id}', [TeamController::class, 'destroy'])->name('team.destroy');
    Route::get('/team/{id}/show', [TeamController::class, 'show'])->name('team.show');


    

        // Projets
        Route::resource('projets', ProjetController::class);

        // Infos Entreprise
        Route::get('/settings', [CompanySettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [CompanySettingController::class, 'update'])->name('settings.update');
    });
});



    

/*
|--------------------------------------------------------------------------
| 4. ESPACE ABONNÉ
|--------------------------------------------------------------------------
*/

// Middleware pour les abonnés
Route::middleware(['auth', 'role:abonné'])->prefix('mon-compte')->name('abonner.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'abonner'])->name('dashboard');
});
