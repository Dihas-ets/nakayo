<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marque;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarqueController extends Controller
{
    public function index()
    {
        $marques = Marque::with('service')->orderBy('created_at', 'desc')->get();
        $services = Service::all();
        return view('admin.marques.index', compact('marques', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'id_service' => 'nullable|exists:services,id_service', // Changé en nullable
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $data = $request->only(['nom', 'id_service']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('marques', 'public');
        }

        Marque::create($data);

        return redirect()->back()->with('success', 'Marque ajoutée avec succès !');
    }

    public function update(Request $request, $id)
    {
        $marque = Marque::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'id_service' => 'nullable|exists:services,id_service', // Changé en nullable
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nom', 'id_service']);

        if ($request->hasFile('image')) {
            if ($marque->image) {
                Storage::disk('public')->delete($marque->image);
            }
            $data['image'] = $request->file('image')->store('marques', 'public');
        }

        $marque->update($data);

        return redirect()->back()->with('success', 'Marque mise à jour !');
    }

    public function destroy($id)
    {
        $marque = Marque::findOrFail($id);
        if ($marque->image) {
            Storage::disk('public')->delete($marque->image);
        }
        $marque->delete();

        return redirect()->back()->with('success', 'Marque supprimée.');
    }
}