<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Vérifie si le rôle de l'utilisateur est autorisé
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirection forcée si accès interdit
        return ($user->role === 'admin' || $user->role === 'rédacteur') 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('abonner.dashboard');
    }
}