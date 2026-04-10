<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallerie;
use App\Models\Service;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GallerieController extends Controller
{
  // app/Http/Controllers/Admin/GallerieController.php

public function index()
{
       // On récupère les médias avec leurs relations, groupés par l'ID du service
    $mediasGrouped = \App\Models\Gallerie::with(['service', 'produit'])
        ->latest()
        ->get()
        ->groupBy('id_service');

    $services = \App\Models\Service::all();
    $produits = \App\Models\Produit::all();

    return view('admin.galleries.index', compact('mediasGrouped', 'services', 'produits'));
}

    public function store(Request $request)
{
    $request->validate([
        'type_media' => 'required|in:image,video',
        'image_url'  => 'required_if:type_media,image|image|max:5120',
        'link'       => 'required_if:type_media,video',
        // ON FORCE LA LIAISON AUX DEUX
        'id_service' => 'required|exists:services,id_service',
        // 'id_produit' => '|exists:produits,id_produit',
    ], [
        'id_service.required' => 'Vous devez lier ce média à un service technique.',
        // 'id_produit.required' => 'Vous devez lier ce média à un produit spécifique.',
    ]);

    $data = $request->all();

    if ($request->hasFile('image_url')) {
        $data['image_url'] = $request->file('image_url')->store('gallery', 'public');
    }

    \App\Models\Gallerie::create($data);

    return redirect()->back()->with('success', 'Média enregistré et lié avec succès !');
}

    public function destroy($id)
    {
        $media = Gallerie::findOrFail($id);
        if ($media->image_url) {
            Storage::disk('public')->delete($media->image_url);
        }
        $media->delete();

        return redirect()->back()->with('success', 'Média supprimé.');
    }
}