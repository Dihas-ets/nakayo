<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    // Liste des membres
    public function index()
    {
        $membres = Membre::orderBy('ordre', 'asc')->get();
        return view('admin.team.index', compact('membres'));
    }

    // Enregistrer un nouveau membre
    public function store(Request $request)
    {


     $request->validate([
        'nom_complet' => 'required',
        'poste' => 'required',
        'photo' => 'nullable|image|max:2048'
    ]);
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'ordre' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('equipe', 'public');
        }

        Membre::create($data);

        return redirect()->back()->with('success', 'Nouveau collaborateur ajouté !');
    }

    // Mettre à jour un profil
    public function update(Request $request, $id)
    {
        $membre = Membre::findOrFail($id);

        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo
            if ($membre->photo) {
                Storage::disk('public')->delete($membre->photo);
            }
            $data['photo'] = $request->file('photo')->store('equipe', 'public');
        }

        $membre->update($data);

        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }

    // Supprimer un membre
    public function destroy($id)
    {
        $membre = Membre::findOrFail($id);

        if ($membre->photo) {
            Storage::disk('public')->delete($membre->photo);
        }

        $membre->delete();

        return redirect()->back()->with('success', 'Membre retiré de l\'équipe.');
    }
}