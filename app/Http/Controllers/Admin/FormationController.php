<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage; // Import indispensable pour gérer les fichiers

class FormationController extends Controller
{
    public function index()
    {
        $offres = Formation::with('service')->latest()->get();
        $services = Service::all();
        return view('admin.formations.index', compact('offres', 'services'));
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.formations.create', compact('services'));
    }

    /**
     * ENREGISTREMENT AVEC IMAGE
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|max:255',
            'id_service' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Validation stricte
            'cout' => 'required|numeric',
            'status' => 'required|in:disponible,non disponible',
            'date_formation' => 'required'
        ]);

        $data = $request->all();

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Stocke dans storage/app/public/formations
            $data['image'] = $request->file('image')->store('formations', 'public');
        }

        // Nettoyage de la date
        try {
            $data['date_formation'] = Carbon::parse($request->date_formation)->format('Y-m-d');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['date_formation' => 'Format de date invalide.']);
        }

        Formation::create($data);

        return redirect()->route('admin.formations.index')->with('success', 'La formation a été publiée avec succès !');
    }

    public function edit($id)
    {
        $offre = Formation::findOrFail($id);
        $services = Service::all();
        return view('admin.formations.edit', compact('offre', 'services'));
    }

    /**
     * MISE À JOUR AVEC IMAGE
     */
    public function update(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        $request->validate([
            'titre' => 'required|max:255',
            'id_service' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Optionnelle à la modif
            'cout' => 'required|numeric',
            'status' => 'required|in:disponible,non disponible',
        ]);

        $data = $request->all();

        // Gestion du changement d'image
        if ($request->hasFile('image')) {
            // 1. Supprimer l'ancienne image si elle existe
            if ($formation->image) {
                Storage::disk('public')->delete($formation->image);
            }
            // 2. Stocker la nouvelle
            $data['image'] = $request->file('image')->store('formations', 'public');
        }

        if($request->filled('date_formation')) {
            try {
                $data['date_formation'] = Carbon::parse($request->date_formation)->format('Y-m-d');
            } catch (\Exception $e) {}
        }

        $formation->update($data);

        return redirect()->route('admin.formations.index')->with('success', 'Formation mise à jour avec succès !');
    }

    /**
     * SUPPRESSION (Nettoie aussi le fichier image)
     */
    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);

        // Supprimer le fichier image du disque avant de supprimer la ligne en base
        if ($formation->image) {
            Storage::disk('public')->delete($formation->image);
        }

        $formation->delete();

        return redirect()->back()->with('success', 'Formation et image supprimées.');
    }

    public function show($id)
    {
        $offre = Formation::with('service')->findOrFail($id);
        return view('admin.formations.show', compact('offre'));
    }
}