<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class CompanySettingController extends Controller
{
    public function index()
    {
        // On récupère le premier enregistrement ou on en crée un vide s'il n'existe pas
        $settings = CompanySetting::firstOrCreate(['id' => 1], [
            'nom_agence' => 'NAKAYO CORPORATION Sarl'
        ]);

        return view('admin.settings.index', compact('settings'));
    }

   public function update(Request $request)
{
    $settings = CompanySetting::findOrFail(1);

    $validated = $request->validate([
        'nom_agence' => 'required|string|max:255',
        'ifu' => 'nullable|string',
        'annee_creation' => 'nullable|numeric',
        'statut_juridique' => 'nullable|string',
        'numero_rccm' => 'nullable|string',
        'telephone_appel' => 'nullable|string',
        'telephone_whatsapp' => 'nullable|string',
        'email' => 'nullable|email',
        'localisation' => 'nullable|string',
        'google_maps_link' => 'nullable|string',
        'facebook_link' => 'nullable|string',
        'instagram_link' => 'nullable|string',
        'linkedin_link' => 'nullable|string',
        'availability_hours' => 'nullable|string',
        'jours_ouverture' => 'nullable|string',
        'horaires_ouverture' => 'nullable|string',
    ]);

    $settings->update($validated);

    return redirect()->back()->with('success', 'Toutes les informations ont été mises à jour !');
}
}