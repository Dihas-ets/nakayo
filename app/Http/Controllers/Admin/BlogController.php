<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Avis;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class BlogController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GESTION DES ARTICLES
    |--------------------------------------------------------------------------
    */
     public function index()
    {
        // 1. Récupérer les paramètres (déjà présent dans vos données Ignition)
        // Remplacez 'paramètres_entreprise' par le nom réel trouvé dans votre base
        $settings = DB::table('company_settings')->first();

        // 2. Récupérer tous les articles avec leur catégorie
        $allArticles = DB::table('articles')
            ->join('categories', 'articles.id_categorie', '=', 'categories.id_categorie')
            ->select(
                'articles.*', 
                'categories.nom as category_name',
                'articles.media as media' // On crée un alias pour éviter l'accent si besoin
            )
            ->where('articles.status', 'publié')
            ->orderBy('articles.created_at', 'desc')
            ->get();

        // 3. Définir l'article à la une (featured)
        // On cherche celui qui a featured = 1, sinon on prend le plus récent
        $featuredArticle = $allArticles->where('featured', 1)->first() ?? $allArticles->first();

        // 4. Filtrer les autres articles (tous sauf celui à la une)
        $otherArticles = $allArticles->where('id_article', '!=', optional($featuredArticle)->id_article);

        // 5. Envoyer TOUT à la vue
        return view('pages.blog', compact('featuredArticle', 'otherArticles', 'settings'));
    }



    public function articles() 
    {
        $articles = Article::with(['auteur', 'categorie'])->withCount('commentaires')->latest()->get();

        // CORRECTION : On récupère les catégories pour la modal d'ajout/modif dans la vue articles
        $categories = Category::all();

        return view('admin.blogs.articles', compact('articles', 'categories'));
    }

    public function create() 
    {
        $categories = Category::all();
        return view('admin.blogs.ajouter', compact('categories'));
    }

    public function store(Request $request) {
    // 1. Validation
    $request->validate([
        'titre' => 'required|max:255', 
        'id_categorie' => 'required', 
        'description' => 'required'
    ]);

    $data = $request->all();
    $data['id_user'] = auth()->id();

    // 2. GÉNÉRATION D'UN SLUG UNIQUE
    // On prend le titre, on le transforme en slug, et on ajoute un ID unique à la fin
    $slugBase = Str::slug($request->titre);
    $data['slug'] = $slugBase . '-' . time(); // Ajoute le timestamp actuel (ex: agro-industrie-17124823)

    $data['commentaire'] = $request->commentaire;
    $data['featured'] = $request->has('featured') ? 1 : 0;
    
    // Idem pour le status si tu veux gérer 'brouillon'
    $data['status'] = $request->has('status') ? 'publié' : 'brouillon';

    // 3. Gestion du média
    if ($request->hasFile('media')) { 
        $data['media'] = $request->file('media')->store('blog', 'public'); 
    }

    // 4. Création
    Article::create($data);

    return redirect()->route('admin.blog.articles')->with('success', 'Article publié !');
}


    public function edit($id) 
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('admin.blogs.modifier', compact('article', 'categories'));
    }

   public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'titre' => 'required',
            'id_categorie' => 'required',
            'description' => 'required',
            'media' => 'nullable|image'
        ]);

        $data = $request->all();

        // GÉNÉRATION D'UN SLUG UNIQUE POUR LA MISE À JOUR
        // On ajoute l'ID à la fin pour éviter les conflits avec d'autres articles
        $data['slug'] = Str::slug($request->titre) . '-' . $id;

        $data['featured'] = $request->has('featured') ? 1 : 0;

        if ($request->hasFile('media')) {
            if($article->media) {
                Storage::disk('public')->delete($article->media);
            }
            $data['media'] = $request->file('media')->store('blog', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.blog.articles')->with('success', 'Article mis à jour avec succès !');
    }

    public function show($id) 
    {
        $article = Article::with(['auteur', 'categorie'])->withCount('commentaires')->findOrFail($id);
        return view('admin.blogs.details', compact('article'));
    }

   public function destroy($id)
{
    // On cherche l'article avec l'ID personnalisé
    $article = \App\Models\Article::findOrFail($id);

    // On supprime l'image du dossier storage s'il y en a une
    if ($article->media) {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($article->media);
    }

    $article->delete();

    return redirect()->route('admin.blog.articles')->with('success', 'L\'article a été supprimé avec succès.');
}



    /*
    |--------------------------------------------------------------------------
    | GESTION DES CATÉGORIES
    |--------------------------------------------------------------------------
    */

    public function categories() 
    {
        $categories = Category::withCount('articles')->get();
        return view('admin.blogs.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['nom' => 'required|max:255', 'slug' => 'required|unique:categories,slug', 'status' => 'required']);
        Category::create($request->all());
        return redirect()->back()->with('success', 'Catégorie créée !');
    }

  public function updateCategory(Request $request, $id_categorie)
{
    $category = Category::findOrFail($id_categorie);

    // Validation stricte : On ignore le slug de la catégorie actuelle pour permettre de valider sans changer le slug
    $request->validate([
        'nom' => 'required|max:255',
        'slug' => 'required|unique:categories,slug,' . $id_categorie . ',id_categorie',
        'status' => 'required|boolean'
    ]);

    // Utilisation de update avec les données validées (Sécurité accrue)
    $category->update($request->only(['nom', 'slug', 'status']));

    return redirect()->back()->with('success', 'La catégorie a été mise à jour !');
}

public function destroyCategory($id_categorie)
{
    $category = Category::findOrFail($id_categorie);
    $category->delete();
    return redirect()->back()->with('success', 'Catégorie supprimée.');
}

    /*
    |--------------------------------------------------------------------------
    | GESTION DES AVIS
    |--------------------------------------------------------------------------
    */

    public function avis()
    {
        $avis = Avis::with('article')->latest()->get();
        return view('admin.blogs.avis', compact('avis'));
    }

    public function updateAvisStatus(Request $request, $id)
    {
        $avis = Avis::findOrFail($id);
        $avis->update(['status' => $request->status]);

        return redirect()->back()->with('success', "Le statut de l'avis a été mis à jour.");
    }

    public function destroyAvis($id)
    {
        Avis::findOrFail($id)->delete();
        return redirect()->back()->with('success', "Avis supprimé.");
    }

    /*
    |--------------------------------------------------------------------------
    | GESTION DES ÉTIQUETTES (TAGS)
    |--------------------------------------------------------------------------
    */

    public function etiquettes()
    {
        $tags = Tag::all();

        // Calcul dynamique du nombre d'articles utilisant ce tag dans la colonne texte 'tag'
        foreach ($tags as $tag) {
            $tag->articles_count = Article::where('tag', 'LIKE', '%' . $tag->nom . '%')->count();
        }

        return view('admin.blogs.etiquettes', compact('tags'));
    }

    public function storeTag(Request $request)
    {
        $request->validate(['nom' => 'required|unique:tags,nom']);
        
        Tag::create([
            'nom' => $request->nom,
            'slug' => Str::slug($request->nom)
        ]);

        return redirect()->back()->with('success', 'Étiquette ajoutée !');
    }

    public function updateTag(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        
        $tag->update([
            'nom' => $request->nom,
            'slug' => Str::slug($request->nom)
        ]);

        return redirect()->back()->with('success', 'Étiquette modifiée !');
    }

    public function destroyTag($id)
    {
        Tag::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Étiquette supprimée.');
    }


    public function uploadImage(Request $request)
{
    if ($request->hasFile('upload')) {
        // 1. Récupérer le fichier
        $file = $request->file('upload');
        
        // 2. Créer un nom unique
        $filename = time() . '_' . $file->getClientOriginalName();
        
        // 3. Stocker l'image dans le dossier public/media
        $file->move(public_path('media'), $filename);

        // 4. Retourner le format JSON attendu par CKEditor
        return response()->json([
            'url' => asset('media/' . $filename)
        ]);
    }

    return response()->json(['error' => 'Erreur lors de l\'upload'], 400);
}

   
}