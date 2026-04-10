<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FormationController extends Controller
{
    /**
     * Liste des formations
     */
    public function index()
    {
        $offres = Formation::with('service')->latest()->get();
        $services = Service::all();
        return view('admin.formations.index', compact('offres', 'services'));
    }

    /**
     * Page de création
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.formations.create', compact('services'));
    }

    /**
     * ENREGISTREMENT (La méthode qui te manquait)
     */
    public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'titre' => 'required|max:255',
            'id_service' => 'required',
            'cout' => 'required|numeric',
            'status' => 'required|in:disponible,non disponible',
            'date_formation' => 'required'
        ]);

        $data = $request->all();

        // 2. Nettoyage de la date pour SQL
        try {
            $data['date_formation'] = Carbon::parse($request->date_formation)->format('Y-m-d');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['date_formation' => 'Format de date invalide.']);
        }

        // 3. Insertion
        Formation::create($data);

        return redirect()->route('admin.formations.index')->with('success', 'La formation a été publiée avec succès !');
    }

    /**
     * Page de modification
     */
    public function edit($id)
    {
        $offre = Formation::findOrFail($id);
        $services = Service::all();
        return view('admin.formations.edit', compact('offre', 'services'));
    }

    /**
     * MISE À JOUR
     */
     public function update(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        // 1. On déplace la validation au début
        $request->validate([
            'titre' => 'required|max:255',
            'id_service' => 'required',
            'cout' => 'required|numeric',
            'status' => 'required|in:disponible,non disponible',
        ]);

        $data = $request->all();

        // 2. Conversion de la date si elle est remplie
        if($request->filled('date_formation')) {
            try {
                $data['date_formation'] = Carbon::parse($request->date_formation)->format('Y-m-d');
            } catch (\Exception $e) {
                // On peut ignorer ou loguer si le format est mauvais
            }
        }

        // 3. Mise à jour en base
        $formation->update($data);

        return redirect()->route('admin.formations.index')->with('success', 'Formation mise à jour avec succès !');
    }

    /**
     * SUPPRESSION
     */
    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();
        return redirect()->back()->with('success', 'Formation supprimée.');
    }


    public function show($id)
{
    // On récupère la formation avec son service lié
    $offre = Formation::with('service')->findOrFail($id);
    
    return view('admin.formations.show', compact('offre'));
}
}