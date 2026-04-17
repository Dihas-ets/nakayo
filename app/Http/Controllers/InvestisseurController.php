<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestisseurController extends Controller
{
    public function index()
    {
        // On définit les projets avec des informations clés pour les investisseurs
        $projets = [
            [
                'nom' => 'Immobilier',
                'description' => 'Complexes résidentiels et commerciaux à haute rentabilité.',
                'icon' => 'fa-building',
                'stat' => 'ROI estimé 15%'
            ],
            [
                'nom' => 'Transport et Logistique',
                'description' => 'Optimisation de la chaîne d\'approvisionnement nationale.',
                'icon' => 'fa-truck',
                'stat' => 'Croissance +20%'
            ],
            [
                'nom' => 'Construction de Piscine',
                'description' => 'Marché en pleine expansion pour l\'hôtellerie et le luxe.',
                'icon' => 'fa-swimming-pool',
                'stat' => 'Demande élevée'
            ],
            [
                'nom' => 'Art et Mode',
                'description' => 'Promotion du savoir-faire local sur les marchés internationaux.',
                'icon' => 'fa-palette',
                'stat' => 'Potentiel export'
            ],
            [
                'nom' => 'Ferme',
                'description' => 'Agriculture durable et sécurité alimentaire.',
                'icon' => 'fa-seedling',
                'stat' => 'Secteur prioritaire'
            ],
            [
                'nom' => 'Fourniture bureautique',
                'description' => 'Solutions de digitalisation pour les PME.',
                'icon' => 'fa-print',
                'stat' => 'Marché stable'
            ],
        ];

        

        return view('pages.investisseurs', compact('projets'));
    }


    public function investisseurs()
    {
        // Votre logique ici (par exemple, retourner la vue)
        return view('pages.investisseurs'); 
    }
}