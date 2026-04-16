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

    /**
     * Enregistre un nouveau partenaire
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'   => 'required|string|max:255',
            'lien'  => 'nullable|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $data = $request->only(['nom', 'lien']);

        if ($request->hasFile('image')) {
            // Stocke l'image dans le dossier storage/app/public/partenaires
            $path = $request->file('image')->store('partenaires', 'public');
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
            if ($partenaire->image) {
                Storage::disk('public')->delete($partenaire->image);
            }
            // Stocker la nouvelle image
            $path = $request->file('image')->store('partenaires', 'public');
            $data['image'] = $path;
        }

        $partenaire->update($data);

        return redirect()->route('admin.partenaires.index')
                         ->with('success', 'Les informations du partenaire ont été mises à jour.');
    }

    /**
     * Supprime un partenaire
     */
    public function destroy($id)
    {
        $partenaire = Partenaire::findOrFail($id);

        // Supprimer l'image physiquement du serveur
        if ($partenaire->image) {
            Storage::disk('public')->delete($partenaire->image);
        }

        $partenaire->delete();

        return redirect()->route('admin.partenaires.index')
                         ->with('success', 'Partenaire supprimé définitivement.');
    }
}