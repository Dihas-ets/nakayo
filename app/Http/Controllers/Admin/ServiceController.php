<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Produit;
use App\Models\Gallerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function index() {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        try {
            // Tu dois envoyer 'services' car ta vue fait un @foreach($services as $s)
            $services = Service::all(); 
            $produits = Produit::all();

            // On passe les deux variables à la vue
            return view('admin.services.create', compact('services', 'produits'));
        } catch (\Exception $e) {
            Log::error('Erreur dans create : ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue');
        }
    }

    public function edit($id) {
        $service = Service::with('galleries')->findOrFail($id);
        
        // On récupère aussi la liste de tous les services pour le menu déroulant si nécessaire
        $services = Service::all(); 
        $produits = Produit::all();

        return view('admin.services.edit', compact('service', 'services', 'produits'));
    }

 public function show($id)
{
    // CHARGEMENT FORCÉ de la galerie
    $service = Service::with('galleries')->findOrFail($id);
    
    return view('admin.services.show', compact('service'));
}

 public function store(Request $request)
{
    // 1. Validation complète (J'ai ajouté 'description')
    $request->validate([
        'titre' => 'required|max:255',
        'courte_description' => 'required',
        'description' => 'required', // Obligatoire pour la fiche
        'media' => 'nullable|image|max:5120',
        'gallery_images' => 'nullable|array',
        'gallery_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        'gallery_videos' => 'nullable|array',
         'status' => 'required|in:publié,brouillon',
    ]);

    // 2. Préparation des données du Service
    // On récupère tout sauf les médias de la galerie
    $data = $request->except(['gallery_images', 'gallery_videos']);
    
    // Gestion de l'image de couverture
    if ($request->hasFile('media')) {
        $data['media'] = $request->file('media')->store('services', 'public');
    } else {
        $data['media'] = 'defaults/default-service.jpg';
    }
    
    // Création du service
    $service = Service::create($data);

    // 3. ENREGISTREMENT DES IMAGES DE LA GALERIE
    if ($request->hasFile('gallery_images')) {
        foreach ($request->file('gallery_images') as $file) {
            if ($file->isValid()) {
                $path = $file->store('gallery', 'public');
                
                Gallerie::create([
                    'id_service' => $service->id_service,
                    // On met null si id_produit n'existe pas dans le formulaire
                    'id_produit' => $request->id_produit ?? null, 
                    'type_media' => 'image',
                    'image_url'  => $path
                ]);
            }
        }
    }

    // 4. ENREGISTREMENT DES VIDÉOS DE LA GALERIE
    if ($request->has('gallery_videos')) {
        foreach ($request->gallery_videos as $videoUrl) {
            if (!empty($videoUrl)) {
                Gallerie::create([
                    'id_service' => $service->id_service,
                    'id_produit' => $request->id_produit ?? null, 
                    'type_media' => 'video',
                    'link'       => $videoUrl
                ]);
            }
        }
    }

    return redirect()->route('admin.services.index')->with('success', 'Service publié avec succès !');
}

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'titre' => 'required|max:255',
            'id_produit' => 'required',
            'courte_description' => 'required',
            'status' => 'required|in:publié,brouillon',
        ]);

        $data = $request->except(['gallery_images', 'gallery_videos', 'id_produit']);

        if ($request->hasFile('media')) {
            if($service->media) Storage::disk('public')->delete($service->media);
            $data['media'] = $request->file('media')->store('services', 'public');
        }

        $service->update($data);

        // On peut ajouter ici la même logique de store pour ajouter de nouveaux médias à la galerie existante

        return redirect()->route('admin.services.index')->with('success', 'Fiche service mise à jour !');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        if ($service->media) {
            Storage::disk('public')->delete($service->media);
        }

        // Les entrées de la table 'galleries' seront supprimées automatiquement 
        // si tu as mis ->onDelete('cascade') dans ta migration.
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Le service a été supprimé.');
    }
}