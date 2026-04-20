<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recrutement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecrutementController extends Controller
{
    public function index()
    {
        $offres = Recrutement::latest()->get();
        return view('admin.recrutements.index', compact('offres'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'nom' => 'required',
        'lieu' => 'required',
        'type' => 'required',
        'date_limite' => 'date', // <--- Vérifie bien l'orthographe ici
        'email_whatsapp' => 'nullable',
        'description' => 'nullable',
        'image' => 'nullable|image'
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('recrutements', 'public');
    }

    $data['status'] = 'publié'; // Par défaut lors de l'ajout
    $data['agence'] = $request->agence;

    \App\Models\Recrutement::create($data);

    return redirect()->back()->with('success', 'Offre de recrutement publiée !');
}
    public function update(Request $request, $id)
{
    $offre = Recrutement::findOrFail($id);

    // 1. Validation stricte
    $request->validate([
        'nom' => 'required|max:255',
        'date_limite' => 'required|date',
        'lieu' => 'required',
        'email_whatsapp' => 'required',
        'description' => 'required',
    ]);

    $data = $request->all();

    // 2. Gestion de l'image
    if ($request->hasFile('image')) {
        if ($offre->image) Storage::disk('public')->delete($offre->image);
        $data['image'] = $request->file('image')->store('recrutements', 'public');
    }

    // 3. Mise à jour
    $offre->update($data);

    return redirect()->back()->with('success', 'L\'offre a été mise à jour avec succès.');
}


    public function destroy($id)
    {
        $offre = Recrutement::findOrFail($id);
        if ($offre->image) Storage::disk('public')->delete($offre->image);
        $offre->delete();
        return redirect()->back()->with('success', 'Offre supprimée.');
    }
}