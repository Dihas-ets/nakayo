<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // On récupère les vraies données
        return view('admin.services.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => 'required|unique:categories,nom']);

        Category::create([
            'nom' => $request->nom,
            'slug' => Str::slug($request->nom),
            'status' => 1
        ]);

        return redirect()->back()->with('success', 'Catégorie ajoutée !');
    }

   public function updateCategory(Request $request, $id)
{
    // On récupère la catégorie (id_categorie est ta clé primaire SQL)
    $category = Category::findOrFail($id);

    $request->validate([
        'nom' => 'required|max:255',
        'slug' => 'required|unique:categories,slug,' . $id . ',id_categorie',
        'status' => 'required'
    ]);

    $category->update([
        'nom' => $request->nom,
        'slug' => $request->slug,
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'La catégorie a été mise à jour !');
}

/**
 * Supprimer une catégorie de blog
 */
public function destroyCategory($id)
{
    $category = Category::findOrFail($id);
    
    // Optionnel : vérifier si la catégorie contient des articles avant de supprimer
    // if($category->articles()->count() > 0) {
    //    return redirect()->back()->with('error', 'Impossible de supprimer une catégorie liée à des articles.');
    // }

    $category->delete();

    return redirect()->back()->with('success', 'La catégorie a été supprimée.');
}
}