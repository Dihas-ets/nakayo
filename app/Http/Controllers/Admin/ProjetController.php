<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjetController extends Controller
{
    public function index() {
        $projets = Projet::with('service')->latest()->get();
        return view('admin.projets.index', compact('projets'));
    }

    public function create() {
        $services = Service::all();
        return view('admin.projets.create', compact('services'));
    }

    public function store(Request $request) {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projets', 'public');
        }
        Projet::create($data);
        return redirect()->route('admin.projets.index')->with('success', 'Projet ajouté au portfolio !');
    }

    public function edit($id) {
        $projet = Projet::findOrFail($id);
        $services = Service::all();
        return view('admin.projets.edit', compact('projet', 'services'));
    }

    public function update(Request $request, $id)
{
    $projet = Projet::findOrFail($id);
    $data = $request->all();

    if ($request->hasFile('image')) {
        if ($projet->image) {
            Storage::disk('public')->delete($projet->image);
        }
        $data['image'] = $request->file('image')->store('projets', 'public');
    }

    $projet->update($data);
    return redirect()->route('admin.projets.index')->with('success', 'Le projet a été mis à jour avec succès !');
}

    public function destroy($id) {
        $projet = Projet::findOrFail($id);
        if ($projet->image) Storage::disk('public')->delete($projet->image);
        $projet->delete();
        return redirect()->back()->with('success', 'Projet supprimé.');
    }
}