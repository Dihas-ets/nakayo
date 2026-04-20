<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    /**
     * Affiche la page de contact
     */
    public function index()
    {
        return view('pages.contact');
    }

    /**
     * Enregistre le message dans la base de données
     */
    public function store(Request $request)
    {
        try {
            // 1. Validation des données
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'objet' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            // 2. Création du message en base de données
            Message::create($validated);

            Mail::to('hadilouidrissou@gmail.com')->send(new ContactMail($validated));

            // 3. Retour avec message de succès
            return back()->with('success', 'Message envoyé avec succès ! Nous vous répondrons bientôt.');

        } catch (\Exception $e) {
            // En cas d'erreur (problème de base de données, etc.)
            return back()->with('error', 'Désolé, une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer.')
                         ->withInput(); // Garde les données saisies pour ne pas tout retaper
        }
    }
}