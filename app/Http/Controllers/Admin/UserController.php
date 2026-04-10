<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * --- VUES (AFFICHAGE) ---
     */

    public function admins()
    {
        $admins = User::where('role', 'admin')->latest()->get();
        return view('admin.users.admins', compact('admins'));
    }

    public function redacteurs()
    {
        $redacteurs = User::where('role', 'rédacteur')->latest()->get();
        return view('admin.users.redacteurs', compact('redacteurs'));
    }

    public function abonnes()
    {
        $abonnes = User::where('role', 'abonné')->latest()->get();
        return view('admin.users.abonnes', compact('abonnes'));
    }

    /**
     * --- ACTIONS (CRUD) ---
     */

    public function store(Request $request)
    {
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,rédacteur,abonné',
            'telephone' => 'nullable|string'
        ]);

        User::create([
            'nom_complet' => $request->nom_complet,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'confirm_password' => $request->password, // Note: Normalement on ne stocke pas ça, mais c'est dans ton SQL
        ]);

        return redirect()->back()->with('success', "L'utilisateur a été créé avec succès.");
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . ',id_user',
            'role' => 'required'
        ]);

        $user->update($request->only(['nom_complet', 'email', 'telephone', 'role']));

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
                'confirm_password' => $request->password
            ]);
        }

        return redirect()->back()->with('success', "Le profil a été mis à jour.");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Empêcher l'admin de se supprimer lui-même
        if ($user->id_user === auth()->id()) {
            return redirect()->back()->with('error', "Vous ne pouvez pas supprimer votre propre compte.");
        }

        $user->delete();
        return redirect()->back()->with('success', "L'utilisateur a été supprimé.");
    }
}