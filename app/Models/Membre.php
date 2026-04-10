<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;

    // On définit la table SQL réelle
    protected $table = 'equipe';

    // On définit la clé primaire personnalisée
    protected $primaryKey = 'id_membre';

    // On autorise le remplissage de ces champs
    protected $fillable = [
        'nom_complet',
        'poste',
        'photo',
        'linkedin',
        'ordre',
        'statut'
    ];
}