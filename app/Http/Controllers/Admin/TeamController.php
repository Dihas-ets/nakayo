<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    // On utilise 'team.index' car votre dossier s'appelle 'team'
    public function index() {
        $membres = Membre::orderBy('ordre', 'asc')->get();
        return view('admin.team.index', compact('membres')); 
    }

    public function create() {
        return view('admin.team.create');
    }

    public function edit($id) {
        $membre = Membre::findOrFail($id);
        return view('admin.team.edit', compact('membre'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_complet' => 'required|string',
            'poste' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'ordre' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        Membre::create($data);

        // Après l'ajout, on redirige vers la LISTE (index) et non en arrière
        return redirect()->route('admin.team.index')->with('success', 'Nouveau collaborateur ajouté !');
    }

    public function update(Request $request, $id)
    {
        $membre = Membre::findOrFail($id);

        $request->validate([
            'nom_complet' => 'required|string',
            'poste' => 'required|string',
            'photo' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($membre->photo) {
                Storage::disk('public')->delete($membre->photo);
            }
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        $membre->update($data);

        // Après la modif, on redirige vers la LISTE
        return redirect()->route('admin.team.index')->with('success', 'Profil mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $membre = Membre::findOrFail($id);
        if ($membre->photo) { Storage::disk('public')->delete($membre->photo); }
        $membre->delete();

        return redirect()->route('admin.team.index')->with('success', 'Membre retiré.');
    }

    public function show($id)
{
    $membre = Membre::findOrFail($id);
    // On pointe vers resources/views/team/show.blade.php
    return view('admin.team.show', compact('membre'));
}
}