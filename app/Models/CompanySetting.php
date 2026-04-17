<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
  protected $fillable = [
    'ifu', 'nom_agence',  
    'numero_rccm', 'telephone_appel', 'telephone_whatsapp', 
    'email', 'localisation', 'google_maps_link', 'facebook_link', 
    'instagram_link', 'linkedin_link', 'availability_hours', 
    'jours_ouverture', 'horaires_ouverture',
    // Nouveaux champs
    'description_footer', 'tiktok_link', 'logo', 'logo_sans_fond', 'favicon'
];
}