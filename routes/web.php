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

    return view('pages.about', compact('team'));
})->name('about');


Route::get('/contact', function () { 
    return view('pages.contact'); 
})->name('contact');

Route::get('/recrutement', function () {
    $offres = DB::table('recrutements')
                ->where('status', 'publié')
                ->orderBy('created_at', 'desc')
                ->get();

    // Vérifiez bien que le fichier est dans resources/views/pages/recrutement.blade.php
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


// page blog
Route::get('/blog', function () {
    $allArticles = DB::table('articles')
    ->join('categories', 'articles.id_categorie', '=', 'categories.id_categorie')
    ->select(
        'articles.*',
        'categories.nom as category_name',
        'articles.Média as media',   // On force le nom 'media' sans accent
        'articles.J\'aime as likes'   // On force le nom 'likes' sans accent
    )
    ->where('articles.status', 'publié')
    ->orderBy('articles.created_at', 'desc')
    ->get();

    $featuredArticle = $allArticles->where('featured', 1)->first() ?? $allArticles->first();
    $otherArticles = $allArticles->where('id_article', '!=', ($featuredArticle->id_article ?? 0));

    return view('blog', compact('featuredArticle', 'otherArticles'));
})->name('blog.index');


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

    // Passer toutes les variables à la vue
    return view('welcome', compact(
        'team',
        'services', 
        'categories', 
        'featuredArticle', 
        'recentArticles', 
        'settings', 
        'projets'
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
                              $q->where('statut', 'disponible')->limit(4);
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
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', function ($slug) {
    $article = Article::where('slug', $slug)->firstOrFail();
    $recentArticles = Article::where('id_article', '!=', $article->id_article)
        ->latest()
        ->take(5)
        ->get();

    return view('blog.show', compact('article', 'recentArticles'));
})->name('blog.show');

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

            // Avis
            Route::get('/avis', [BlogController::class, 'avis'])->name('avis');
            Route::put('/avis/{id}/status', [BlogController::class, 'updateAvisStatus'])->name('avis.status');
            Route::delete('/avis/{id}', [BlogController::class, 'destroyAvis'])->name('avis.destroy');

            // Etiquettes
            Route::get('/etiquettes', [BlogController::class, 'etiquettes'])->name('etiquettes');
            Route::post('/etiquettes', [BlogController::class, 'storeTag'])->name('etiquettes.store');
            Route::put('/etiquettes/{id}', [BlogController::class, 'updateTag'])->name('etiquettes.update');
            Route::delete('/etiquettes/{id}', [BlogController::class, 'destroyTag'])->name('etiquettes.destroy');
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
