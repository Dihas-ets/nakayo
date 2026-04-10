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
use App\Models\Service; // Ajoutez cette ligne
use App\Models\CompanySetting;
use App\Models\Article;





/*
|--------------------------------------------------------------------------
| 1. ROUTES PUBLIQUES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $categories = DB::table('categories')->where('status', 1)->get();
    $featuredArticle = DB::table('articles')
        ->join('categories', 'articles.id_categorie', '=', 'categories.id_categorie')
        ->select('articles.*', 'categories.nom as category_name')
        ->where('featured', 1)->first();
    $recentArticles = DB::table('articles')
        ->join('categories', 'articles.id_categorie', '=', 'categories.id_categorie')
        ->select('articles.*', 'categories.nom as category_name')
        ->where('featured', 0)->orderBy('articles.created_at', 'desc')->limit(3)->get();
    return view('welcome', compact('categories', 'featuredArticle', 'recentArticles'));


    
})->name('home');

Route::get('/a-propos', function () { return view('pages.about'); })->name('about');
Route::get('/contact', function () { return view('pages.contact'); })->name('contact');
Route::get('/recrutement', function () { return view('pages.recrutement'); })->name('recrutement');









/*
|--------------------------------------------------------------------------
| 1. ROUTE ACCUEIL (Slider Dynamique + Blog)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // A. On récupère les services pour le slider
    $services = Service::where('status', 'publié')->get();

    // B. On récupère les infos de l'entreprise
    $settings = CompanySetting::first();

    // C. Logiques de blog existantes
    $categories = DB::table('categories')->where('status', 1)->get();
    
    $featuredArticle = DB::table('articles')
        ->join('categories', 'articles.id_categorie', '=', 'categories.id_categorie')
        ->select('articles.*', 'categories.nom as category_name')
        ->where('featured', 1)->first();

    $recentArticles = DB::table('articles')
        ->join('categories', 'articles.id_categorie', '=', 'categories.id_categorie')
        ->select('articles.*', 'categories.nom as category_name')
        ->where('featured', 0)
        ->orderBy('articles.created_at', 'desc')
        ->limit(3)->get();

    // D. AJOUT : Logique pour les réalisations (Projets)
    $projets = DB::table('projets')
        ->join('services', 'projets.id_service', '=', 'services.id_service')
        ->select('projets.*', 'services.titre as service_nom')
        ->where('projets.status', 'publié')
        ->orderBy('projets.date_realisation', 'desc')
        ->limit(4)
        ->get();

    // On passe TOUTES les variables à la vue
    return view('welcome', compact(
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
| 2. ROUTES SERVICES (Vos routes existantes)
|--------------------------------------------------------------------------
*/

// Détail du service (4 produits + Galerie + Settings)
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

// Route catalogue complet
Route::get('/services/{id}/produits', function ($id) {
    $service = Service::where('id', $id)
        ->with(['produits' => fn($q) => $q->where('statut', 'disponible')])
        ->firstOrFail();

    return view('services.products', compact('service'));
})->name('services.products');

// Catalogue complet (Tous les produits + Settings)
Route::get('/services/{slug}/catalogue', function ($slug) {
    $mapping = [
        'construction-piscine' => 'Construction Piscine',
        'immobilier'           => 'NAKAYO Immobilier',
        'papeterie'            => 'Papeterie',
        'savonnerie'           => 'Savonnerie',
        'agro-industrie'       => 'Agro industrie et élevage' 
    ];

    if (!isset($mapping[$slug])) abort(404);

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




Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', function ($slug) {

    $article = Article::where('slug', $slug)->firstOrFail();

    $recentArticles = Article::where('id_article', '!=', $article->id_article)
        ->latest()
        ->take(5)
        ->get();

    return view('blog.show', compact('article', 'recentArticles'));

})->name('blog.show');
Route::get('/realisations/projets', function () { return view('realisations.projets'); })->name('realisations.projets');
Route::get('/realisations/galerie', function () { return view('realisations.galerie'); })->name('realisations.galerie');




/*
|--------------------------------------------------------------------------
| 2. AUTHENTIFICATION
|--------------------------------------------------------------------------
*/
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
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // --- ACCÈS COMMUN : ADMIN & RÉDACTEUR ---
    Route::middleware(['role:admin,rédacteur'])->group(function () {
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


             Route::get('/avis', [BlogController::class, 'avis'])->name('avis');
            Route::put('/avis/{id}/status', [BlogController::class, 'updateAvisStatus'])->name('avis.status');
            Route::delete('/avis/{id}', [BlogController::class, 'destroyAvis'])->name('avis.destroy');
            
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

        // --- GESTION DES PRODUITS ---
            // --- GESTION DES PRODUITS ---
        Route::get('/produits', [ProductController::class, 'index'])->name('produits.index');
        Route::get('/produits/creer', [ProductController::class, 'create'])->name('produits.create');
        Route::post('/produits', [ProductController::class, 'store'])->name('produits.store');

        // AJOUTE CETTE LIGNE (Celle qui manque)
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
        Route::prefix('equipe')->name('team.')->group(function () {
            Route::get('/', [TeamController::class, 'index'])->name('index');
            Route::post('/', [TeamController::class, 'store'])->name('store');
            Route::put('/{id}', [TeamController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [TeamController::class, 'destroy'])->name('destroy');
        });

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
Route::middleware(['auth', 'role:abonné'])->prefix('mon-compte')->name('abonner.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'abonner'])->name('dashboard');
});