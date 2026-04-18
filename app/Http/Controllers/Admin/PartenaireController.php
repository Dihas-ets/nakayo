<?php

namespace App\Http\Controllers\Admin;

// AJOUTEZ CETTE LIGNE CI-DESSOUS :
use App\Http\Controllers\Controller; 

use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Maintenant, PHP saura où trouver ce "Controller"
class PartenaireController extends Controller 
{
    /**
     * Affiche la liste des partenaires
     */
    public function index()
    {


    
        $partenaires = Partenaire::orderBy('created_at', 'desc')->get();
        return view('admin.partenaires.index', compact('partenaires'));
    }

     

    public function store(Request $request)
    {
        $request->validate([
            'nom'   => 'required|string|max:255',
            'lien'  => 'nullable|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $data = $request->only(['nom', 'lien']);

        if ($request->hasFile('image')) {
            // .store('dossier') utilise automatiquement le disque par défaut définit dans FILESYSTEM_DISK
            // Il retourne le CHEMIN du fichier (ex: partenaires/nom.jpg)
            $path = $request->file('image')->store('partenaires');
            
            $data['image'] = $path;
        }

        Partenaire::create($data);

        return redirect()->route('admin.partenaires.index')
                        ->with('success', 'Le partenaire a été ajouté avec succès !');
    }




    /**
     * Met à jour un partenaire existant
     */
    public function update(Request $request, $id)
    {
        $partenaire = Partenaire::findOrFail($id);

        $request->validate([
            'nom'   => 'required|string|max:255',
            'lien'  => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $data = $request->only(['nom', 'lien']);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
          if ($partenaire->image && !str_starts_with($partenaire->image, 'http')) {
        Storage::delete($partenaire->image);
    }

    $path = $request->file('image')->store('partenaires');
            $data['image'] = $path;
        }

        $partenaire->update($data);

        return redirect()->route('admin.partenaires.index')
                         ->with('success', 'Les informations du partenaire ont été mises à jour.');
    }

    /**
     * Supprime un partenaire
     */
    // public function destroy($id)
    // {
    //     $partenaire = Partenaire::findOrFail($id);

    //     // Supprimer l'image physiquement du serveur
    //     if ($partenaire->image) {
    //         Storage::disk('public')->delete($partenaire->image);
    //     }

    //     $partenaire->delete();

    //     return redirect()->route('admin.partenaires.index')
    //                      ->with('success', 'Partenaire supprimé définitivement.');
    // }


        public function destroy($id)
    {
        $partenaire = Partenaire::findOrFail($id);

        if ($partenaire->image) {
            // Supprime le fichier sur le disque actuel (Cloudinary ou Local)
            Storage::delete($partenaire->image);
        }

        $partenaire->delete();

        return redirect()->route('admin.partenaires.index')
                        ->with('success', 'Supprimé avec succès.');
    }
}