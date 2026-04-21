<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Commentaire; // Assure-toi que le nom du model est exact
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Affiche la liste des articles (Page Index)
     */
    public function index()
    {
        // On récupère l'article mis en avant (featured)
        $featuredArticle = Article::where('featured', 1)
                            ->where('status', 'publié')
                            ->latest()
                            ->first();

        // On récupère les autres articles pour la grille
        $otherArticles = Article::where('status', 'publié')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('blog.index', compact('featuredArticle', 'otherArticles'));
    }

    /**
     * Affiche le détail d'un article
     */
    public function show($slug)
    {
        // Récupérer l'article avec ses relations (Eager Loading pour la performance)
        $article = Article::with(['category', 'commentaires' => function($query) {
            $query->where('statut', 'approuvé')->latest(); // On ne prend que les commentaires validés
        }])->where('slug', $slug)->firstOrFail();

        // Incrémenter dynamiquement le nombre de vues à chaque visite
        $article->increment('vue');

        // Récupérer les articles de la même catégorie (Articles similaires)
        $relatedArticles = Article::where('id_categorie', $article->id_categorie)
                            ->where('id_article', '!=', $article->id_article)
                            ->where('status', 'publié')
                            ->limit(3)
                            ->get();

        // Articles récents pour une éventuelle sidebar ou section
        $recentArticles = Article::where('id_article', '!=', $article->id_article)
                            ->where('status', 'publié')
                            ->latest()
                            ->limit(5)
                            ->get();

        return view('blog.show', compact('article', 'relatedArticles', 'recentArticles'));
    }

    /**
     * Enregistre un nouveau commentaire
     */
    public function storeComment(Request $request, $id_article)
    {
        $request->validate([
            'nom_auteur' => 'required|string|max:255',
            'email_auteur' => 'required|email|max:255',
            'contenu' => 'required|string|min:5',
        ]);

        Commentaire::create([
            'id_article' => $id_article,
            'nom_auteur' => $request->nom_auteur,
            'email_auteur' => $request->email_auteur,
            'contenu' => $request->contenu,
            'statut' => 'approuvé', // Tu peux mettre 'en_attente' si tu veux modérer
        ]);

        return back()->with('success', 'Merci ! Votre commentaire a été publié.');
    }

    /**
     * Gère les likes sur un article
     */
    public function like($id_article)
    {
        $article = Article::findOrFail($id_article);
        
        // Incrémente le champ likes dans la base de données
        $article->increment('likes');

        return back()->with('success', 'Merci pour votre mention J\'aime !');
    }
}