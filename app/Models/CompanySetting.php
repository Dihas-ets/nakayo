<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class CompanySetting extends Model
{
  protected $fillable = [
    'ifu', 'nom_agence',  
     'telephone_appel', 'telephone_whatsapp', 
    'email', 'localisation', 'google_maps_link', 'facebook_link', 
    'instagram_link', 'linkedin_link', 'availability_hours', 
    'annee_creation',
    'horaires_ouverture',
    'jours_ouverture',
    'statut_juridique',
    'numero_rccm',
    // Nouveaux champs
    'description_footer', 'tiktok_link', 'logo', 'logo_sans_fond', 'favicon'
];





protected function logoSansFondUrl(): Attribute
{
    return Attribute::get(function () {
        if (!$this->logo_sans_fond) return url('images/1.jpg');

        if (str_starts_with($this->logo_sans_fond, 'http')) {
            return $this->logo_sans_fond;
        }

        return Storage::url($this->logo_sans_fond);
    });
}


protected function faviconUrl(): Attribute
{
    return Attribute::get(function () {
        if (!$this->favicon) return url('images/1.jpg');

        if (str_starts_with($this->favicon, 'http')) {
            return $this->favicon;
        }

        return Storage::url($this->favicon);
    });
}

protected function logoUrl(): Attribute
{
    return Attribute::get(function () {
        if (!$this->logo) return url('images/1.jpg');

        if (str_starts_with($this->logo, 'http')) {
            return $this->logo;
        }

        return Storage::url($this->logo);
    });
}


}