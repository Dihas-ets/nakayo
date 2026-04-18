<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    /**
     * Liste des produits (Tableau principal)
     */
    public function index()
    {
        // On récupère les produits avec la relation service chargée (Eager Loading)
        $produits = Produit::with('service')->latest()->get();
        return view('admin.produits.index', compact('produits'));
    }

    /**
     * Page de création (CMS)
     */
    public function create()
    {
        $services = Service::all(); // Nécessaire pour le menu déroulant
        return view('admin.produits.create', compact('services'));
    }

    /**
     * Enregistrement du produit
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|max:255',
            'id_service' => 'required|exists:services,id_service',
            'prix' => 'nullable|numeric', 
            'description' => 'required',
            'image' => 'nullable|image', 
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('produits', 'public');
        }

        Produit::create($data);

        // Redirection vers la liste des produits
        return redirect()->route('admin.produits.index')->with('success', 'Le produit a été ajouté au catalogue avec succès !');
    }

    /**
     * Page de modification (CMS)
     */
    public function edit($id)
    {
        // On utilise id_produit car c'est ta clé primaire SQL
        $produit = Produit::findOrFail($id);
        $services = Service::all();
        
        return view('admin.produits.edit', compact('produit', 'services'));
    }

    /**
     * Mise à jour du produit
     */
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        $request->validate([
            'nom' => 'required|max:255',
            'id_service' => 'required|exists:services,id_service',
            'prix' => 'nullable|numeric', 
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }
            $data['image'] = $request->file('image')->store('produits', 'public');
        }

        $produit->update($data);

        return redirect()->route('admin.produits.index')->with('success', 'La fiche produit a été mise à jour.');
    }

    /**
     * Suppression du produit
     */
    // public function destroy($id)
    // {
    //     $produit = Produit::findOrFail($id);
        
    //     if ($produit->image) {
    //         Storage::disk('public')->delete($produit->image);
    //     }

    //     $produit->delete();

    //     return redirect()->route('admin.produits.index')->with('success', 'Produit retiré de l\'inventaire.');
    // }


 

public function destroy($id)
{
    $partenaire = Partenaire::findOrFail($id);

    if ($partenaire->image) {
        // Extraction de l'ID à partir de l'URL :
        // https://res.cloudinary.com/cloudname/image/upload/v123/partenaires/abcde.png
        // deviendra : partenaires/abcde
        
        $path = parse_url($partenaire->image, PHP_URL_PATH);
        $segments = explode('/', $path);
        $uploadIndex = array_search('upload', $segments);

        if ($uploadIndex !== false) {
            // Récupère tout après 'v12345/'
            $publicIdWithExtension = implode('/', array_slice($segments, $uploadIndex + 2));
            // Retire l'extension (.png, .jpg)
            $publicId = pathinfo($publicIdWithExtension, PATHINFO_FILENAME);
            
            // On rajoute le dossier 'partenaires/' devant
            $fullPublicId = 'partenaires/' . $publicId;

            Cloudinary::destroy($fullPublicId);
        }
    }

    $partenaire->delete();

    return redirect()->route('admin.partenaires.index')
                     ->with('success', 'Partenaire supprimé avec succès.');
}


public function show($id)
{
    // On récupère le produit avec les infos du service lié
    $produit = \App\Models\Produit::with('service')->findOrFail($id);
    
    return view('admin.produits.show', compact('produit'));
}

}