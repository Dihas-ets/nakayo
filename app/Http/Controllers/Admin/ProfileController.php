<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    public function updateInfo(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id_user . ',id_user',
            'telephone' => 'nullable|string',
        ]);

        $user->update($request->only(['nom_complet', 'email', 'telephone']));

        return redirect()->back()->with('success', 'Vos informations ont été mises à jour.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
            'confirm_password' => $request->new_password // Pour rester cohérent avec ton SQL
        ]);

        return redirect()->back()->with('success', 'Mot de passe modifié avec succès.');
    }
}