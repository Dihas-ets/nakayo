<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

    // CONNEXION
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin' || $user->role === 'rédacteur') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('abonner.dashboard');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }

    // INSCRIPTION (Abonné uniquement)
    public function register(Request $request)
    {
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telephone' => 'required',
            'password' => 'required|min:6',
            'confirmpassword' => 'required|same:password',
        ]);

        $user = User::create([
            'nom_complet' => $request->nom_complet,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'role' => 'abonné',
            'password' => Hash::make($request->password),
            'confirm_password' => $request->confirmpassword, // Stockage tel quel selon ton SQL
        ]);

        Auth::login($user);
        return redirect()->route('abonner.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}