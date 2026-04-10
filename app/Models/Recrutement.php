<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recrutement extends Model
{
    use HasFactory;

    // Nom de la table dans ton SQL
    protected $table = 'recrutements';

    // Ta clé primaire personnalisée
    protected $primaryKey = 'id_recrutement';

    // Liste des champs que l'on peut remplir (Mass Assignment)
    protected $fillable = [
        'nom',
        'image',
        'description',
        'lieu',
        'agence',
        'type',
        'date_limite',
        'email_whatsapp',
        'status'
    ];

    // Si tu utilises des dates, Laravel les traitera comme des objets Carbon
    protected $casts = [
        'date_limite' => 'date',
    ];
}