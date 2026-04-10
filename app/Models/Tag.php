<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // On définit la table et la clé primaire personnalisée
    protected $table = 'tags';
    protected $primaryKey = 'id_tag';

    // Champs autorisés à l'écriture
    protected $fillable = [
        'nom',
        'slug'
    ];
}