<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CompanySettingController extends Controller
{
    public function index()
    {
        $settings = CompanySetting::firstOrCreate(['id' => 1], [
            'nom_agence' => 'NAKAYO CORPORATION Sarl'
        ]);

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = CompanySetting::findOrFail(1);

        $validated = $request->validate([
            'nom_agence'         => 'required|string|max:255',
            'ifu'                => 'nullable|string',
            
            'statut_juridique'   => 'nullable|string',
            'numero_rccm'        => 'nullable|string',
            'telephone_appel'    => 'nullable|string',
            'telephone_whatsapp' => 'nullable|string',
            'email'              => 'nullable|email',
            'localisation'       => 'nullable|string',
            'google_maps_link'   => 'nullable|string',
            'facebook_link'      => 'nullable|string',
            'instagram_link'     => 'nullable|string',
            'linkedin_link'      => 'nullable|string',
            'tiktok_link'        => 'nullable|string',
            'availability_hours' => 'nullable|string',
            'jours_ouverture'    => 'nullable|string',
            'horaires_ouverture' => 'nullable|string',
            'description_footer' => 'nullable|string',
            'logo'               => 'nullable|image',
            'logo_sans_fond'     => 'nullable|image',
            'favicon'            => 'nullable|image',
        ]);

        try {
            // Liste des champs image à traiter
            $imageFields = ['logo', 'logo_sans_fond', 'favicon'];

            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    // 1. Supprimer l'ancien fichier s'il existe
                    if ($settings->$field && Storage::disk('public')->exists($settings->$field)) {
                        Storage::disk('public')->delete($settings->$field);
                    }

                    // 2. Stocker le nouveau fichier (Laravel gère tout seul)
                    $path = $request->file($field)->store('settings', 'public');
                    
                    // 3. Ajouter le chemin au tableau validé
                    $validated[$field] = $path;
                }
            }

            // Mise à jour en base de données
            $settings->update($validated);

            return redirect()->back()->with('success', 'Configuration mise à jour avec succès !');

        } catch (\Exception $e) {
            Log::error("Erreur settings : " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }
}